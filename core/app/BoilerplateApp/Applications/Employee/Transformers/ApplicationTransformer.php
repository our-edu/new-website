<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\BoilerplateApp\Applications\Models\ChildApplication;
use Carbon\Carbon;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class ApplicationTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'registerationAttachments',
//        'attachments',
        'paymentMethod',
        'services',
        'paymentAttachments',
        'actions',
    ];
    protected $availableIncludes = [
    ];

    private $params;

    public function __construct($params = [])
    {
        $this->params = $params;
    }

    /**
     * @param ChildApplication $application
     * @return array
     */
    public function transform(ChildApplication $application): array
    {
        $transformerData = [
            'id' => $application->uuid,
            'parent_name' => $application->parent->user->name ?? null,
            'child_name' => $application->first_name ?? null,
            'child_national_id' => $application->national_id ?? null,
            'applied_at'=>Carbon::parse($application->created_at)->format('d M Y') ?? null,
            'status' => $application->currentStatus()->first()->status ?? null,
            'grade'=>$application->grade->name ?? null,
            'child_image'=>$application->childImage->url ?? null,
            'child_birthdate'=>Carbon::parse($application->birthdate)->format('d M Y') ?? null,
            'total_bill_amount'=>$application->serviceOrder->total ?? 0,
            'bayed_amount'=>'',
            'reason'=>
                ($application->currentStatus()->first()->status == 'returned' || $application->currentStatus()->first()->status == 'rejected'  )
                ? $application->currentStatus()->first()->reason
                : null
        ];
        return $transformerData;
    }
    
    /**
     * @return Collection|null
     */
    public function includeActions(ChildApplication $application)
    {
        $paymentMethod = $application->paymentMethod()->exists() ? $application->paymentMethod->type : null;
        $actions = [];
        if ($paymentMethod == 'wire_transfer' || $paymentMethod == 'cash') {
            $actions[] = [
                'endpoint_url' => env("PAYMENT_URL") . "/employee/payments/" . $application->uuid .
                    ($paymentMethod == 'wire_transfer' ? '/wire' : '/cash'),
                'label' => __("applications.payment"),
                'method' => 'POST',
                'key' => APIActionsEnums::PAYMENT_URL,
            
            ];
        }
        
        if (count($actions)) {
            return $this->collection($actions, new ActionTransformer(), ResourceTypesEnums::ACTION);
        }
    }
    /**
     * @return Collection|null
     */
    public function includePaymentAttachments(ChildApplication $application)
    {
        if ($application->paymentMethod()->exists() && $application->paymentMethod->type == 'wire_transfer' && $application->paymentAttachments()->count() != 0) {
            return $this->collection($application->paymentAttachments, new AttachmentTransformer(), ResourceTypesEnums::UPLOADED_MEDIA);
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
