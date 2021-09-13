<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Repository;

use App\BaseApp\Enums\ApplicationStatusEnums;
use App\BaseApp\Enums\ServiceTypesEnums;
use App\BaseApp\Enums\VatValueEnum;
use App\BaseApp\Exceptions\BaseErrorException;
use App\BoilerplateApp\Applications\Models\ChildApplication;
use App\BoilerplateApp\Applications\Models\Service;
use App\BoilerplateApp\Applications\Models\ServiceOrder;
use App\BoilerplateApp\Bills\Models\Bill;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Validator\Exceptions\ValidatorException;
use Ramsey\Uuid\Uuid;

class ApplicationRepository extends BaseRepository implements ApplicationRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return ChildApplication::class;
    }

    public function getFilteredApplicationsPaginate($request, $branchID): LengthAwarePaginator
    {

        $items = $this->where('branch_id', $branchID);

        if ($request->has('national_id') && $request->get('national_id') != '') {
            $items = $items->whereHas('parent', function ($query) use ($request) {
                $query->whereHas('user', function ($query) use ($request) {
                    $query->where('national_id', $request->get('national_id'));
                });
            });
        }
//        if ($request->has('parent_id') && $request->get('parent_id') != '') {
//            $items = $items->whereHas('parent', function ($query) use ($request) {
//                $query->where('parent_id', $request->get('parent_id'));
//            });
//        }
        if ($request->has('status') && $request->get('status') != '') {
            $applicationUuids = [];
            $allApplications = $items->get();
            foreach ($allApplications as $application) {
                if ($application->currentStatus()->first()->status == $request->get('status')) {
                    $applicationUuids[] = $application->uuid;
                }
            }
            $items = $items->whereIn('uuid', $applicationUuids);
        }

        return $items->orderBy('created_at', 'desc')->paginate();
    }

    public function setStatus($application_uuid, $status, $reason = null) : bool
    {
        $application = $this->find($application_uuid);
        $createdStatus = $application->statuses()->create([
            'status' => $status,
            'reason' => $reason
        ]);
        return $createdStatus->exists();
    }

    /**
     * attach application attachments
     * @param string $application_uuid
     * @param array $data
     * @return bool
     */

    public function createAttachments(string $application_uuid, array $data): bool
    {
        $application = $this->find($application_uuid);
        $dataToAttach = [];
        foreach ($data as $item) {
            foreach ($item['files'] as $file) {
                $dataToAttach[$file] = ['registration_attachment_uuid' => $item['attachment_uuid']];
            }
        }

        if ($application->attachments()->attach($dataToAttach)) {
            return true;
        }
        return false;
    }

    public function createApplicationStatus(string $application_uuid, array $attributes): bool
    {
        $application = $this->find($application_uuid);
        if ($application->statuses()->create($attributes)) {
            return true;
        }
        return false;
    }

    /**
     * @param $id
     * @param array|string[] $columns
     * @return ChildApplication
     */
    public function find($id, $columns = ['*']): ChildApplication
    {
        return parent::find($id, $columns);
    }

    /**
     * @param array $attributes
     * @return ChildApplication
     * @throws ValidatorException
     */
    public function create(array $attributes): ChildApplication
    {
        return parent::create($attributes);
    }

    /**
     * @param array $attributes
     * @param $id
     * @return ChildApplication
     * @throws ValidatorException
     */
    public function update(array $attributes, $id): ChildApplication
    {
        return parent::update($attributes, $id);
    }


    public function updateAttachments(string $application_uuid, array $data): bool
    {
        $application = $this->find($application_uuid);
        if ($application->attachments()->sync($data)) {
            return true;
        }
        return false;
    }

    public function createApplicationBill(string $application_uuid, string $service_order_uuid, float $total): bool
    {
        $application = $this->find($application_uuid);
        $serviceOrder = ServiceOrder::find($service_order_uuid);
        if (!$application->hasBill()) {
            DB::beginTransaction();
            try {
                $bill = $application->bill()->create([
                    'amount' => $serviceOrder->total,
                    'vat' => $serviceOrder->vat,
                    'amount_with_vat' => $serviceOrder->total_with_vat,
                    'min_payment' => 0,
                    'bill_type' => "school_subscription",
                    'details' => $application->toJson(),
                    'payer' => $application->parent->user->uuid,
                    'service_order_uuid' => $service_order_uuid,
                    'notes' => "school_subscription"

                ]);
                $bill->transaction()->create([
                    'credit_amount' => $serviceOrder->total_with_vat,
                    'debit_amount' => 0,
                    'transaction_date' => now(),
                    'details' => $application->toJson(),
                    'notes' => "school_subscription",
                    'payer_id' => $application->parent->user->uuid,

                ]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                Log::error($e);
                throw new BaseErrorException($e->getMessage());
            }

            return true;
        }
        return false;
    }

    public function createApplicationServiceOrder(string $application_uuid, array $services, float $total_cost): ServiceOrder
    {
        $application = $this->find($application_uuid);
        $servicesArray = [];
        $total_vat = 0;

        foreach ($services as $serviceData) {
            $service = Service::find($serviceData['service_uuid']);
            if (!empty($serviceData['service_uuid']) && !empty($serviceData['cost']) && !empty($service)) {
                if ($service->type == 'subscription' && Str::startsWith($application->national_id, '1')) {
                    $vat = 0;
                } else {
                    $vat = $serviceData['cost'];
                }

                $priceWithVat = $serviceData['cost'] + $vat;

                $servicesArray[] = ['uuid' => Uuid::uuid4()->toString(),
                    'price' => $serviceData['cost'],
                    'service_uuid'=>$serviceData['service_uuid'],
                    'vat' => $vat,
                    'price_with_vat' => $priceWithVat,
                    'service_grade_uuid'=>(!empty($serviceData['service_grade_uuid']))  ? $serviceData['service_grade_uuid'] : null
                ];
                $total_vat += $vat;
            }
        }
        $orderService = $application->serviceOrder()->create([
            'total' => $total_cost,
            'total_with_vat' => $total_vat + $total_cost,
            'vat' => $total_vat,
            'status' => 1
        ]);
        $orderService->services()->sync($servicesArray);
        return $orderService;
    }
}
