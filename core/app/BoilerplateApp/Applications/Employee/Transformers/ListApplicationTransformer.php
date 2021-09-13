<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\BoilerplateApp\Applications\Models\ChildApplication;
use App\BoilerplateApp\Applications\Parent\Transformers\ListPaymentMethodTransformer;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class ListApplicationTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'actions',
        'paymentMethod',
    ];
    protected $availableIncludes = [
    ];
    
    private $params;
    
    public function __construct($params = [])
    {
        $this->params = $params;
    }
    
    /**
     * @return (mixed|null|string)[]
     *
     * @psalm-return array{id: mixed, parent_name: mixed|null, child_name: null|string, child_national_id: null|string,
     * applied_at: null|string, status: mixed|null, grade: mixed|null, total_bill_amount: mixed|null}
     */
    public function transform(ChildApplication $application): array
    {
        $transformerData = [
            'id' => $application->uuid,
            'parent_name' => $application->parent->user->name ?? null,
            'child_name' => $application->first_name ?? null,
            'child_national_id' => $application->national_id ?? null,
            'applied_at' => Carbon::parse($application->created_at)->format('d M Y') ?? null,
            'status' => $application->currentStatus()->first()->status ? trans('enums.'.$application->currentStatus()->first()->status) : null,
            'grade' => $application->grade->name ?? null,
            'total_bill_amount' => ($application->serviceOrder()->exists() )   ? $application->serviceOrder->total : null,
        ];
        return $transformerData;
    }
    
    /**
     * @return \League\Fractal\Resource\Collection|null
     */
    public function includeActions(ChildApplication $application)
    {
        $currentStatus = $application->currentStatus()->first()->status;
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.applications.show', [
                'application' => $application
            ]),
            'label' => __("applications.showApplication"),
            'method' => 'GET',
            'key' => APIActionsEnums::SHOW_APPLICATION,
        
        ];
        
        if ($currentStatus != "rejected") {
            $actions[] = [
                'endpoint_url' => buildScopeRoute('api.employee.applications.reject', [
                    'application' => $application
                ]),
                'label' => __("applications.rejectStatusApplication"),
                'method' => 'PUT',
                'key' => APIActionsEnums::REJECT_STATUS_APPLICATION,
            
            ];
        }
        
        if (count($actions)) {
            return $this->collection($actions, new ActionTransformer(), ResourceTypesEnums::ACTION);
        }
    }
    
    public function includePaymentMethod(ChildApplication $application)
    {
        if ($application->paymentMethod()->exists()) {
            return $this->collection(
                $application->paymentMethod()->get(),
                new PaymentMethodTransformer($application),
                ResourceTypesEnums::PAYMENT_METHOD
            );
        }
    }
}
