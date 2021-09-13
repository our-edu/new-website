<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\BaseApp\Enums\ApplicationStatusEnums;
use App\BaseApp\Enums\PaymentMethodTypeEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BoilerplateApp\Applications\Models\ChildApplication;
use App\BoilerplateApp\Applications\Models\PaymentMethod;
use League\Fractal\TransformerAbstract;

class PaymentMethodTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [

    ];
    protected $availableIncludes = [
    ];

    private $childApplication;

    public function __construct(ChildApplication $childApplication)
    {
        $this->childApplication = $childApplication;
    }

    public function transform(PaymentMethod $paymentMethod)
    {
        $transformerData = [
            'id' => $paymentMethod->uuid,
            'name' => $paymentMethod->name ?? '',
            'type' => $paymentMethod->type ?? '',

        ];
        return $transformerData;
    }

    /**
     * @return \League\Fractal\Resource\Collection|null
     */
}
