<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Employee\Transformers;

use App\BaseApp\Enums\ResourceTypesEnums;
use App\BoilerplateApp\Applications\Models\ChildApplication;
use App\BoilerplateApp\Applications\Models\Service;
use App\BoilerplateApp\Applications\Models\ServiceOrderItem;
use App\BoilerplateApp\Branches\Models\Branch;
use App\BoilerplateApp\Branches\Parent\Transformers\ListBusRoutesTransformer;
use League\Fractal\TransformerAbstract;

class ListServiceTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [

        ];
    protected $availableIncludes = [
    ];

    private $application;

    public function __construct(ChildApplication $application)
    {
        $this->application =  $application;
    }

    public function transform(ServiceOrderItem $serviceOrderItem)
    {
        $transformerData = [
            'id' => $serviceOrderItem->uuid,
            'name' => $serviceOrderItem->service->translate(app()->getLocale())->name ?? '',
            'semester'=>$serviceOrderItem->serviceGrade()->count() > 0 ? $serviceOrderItem->serviceGrade->semester->semester->name : null,
            'type' => $serviceOrderItem->service->type ?? '',
            'mandatory' => $serviceOrderItem->service->mandatory,
            'show' => $serviceOrderItem->service->show,
            'cost'=> $serviceOrderItem->price,
            'vat'=>$serviceOrderItem->vat,
            'cost_with_vat'=>$serviceOrderItem->price_with_vat,

        ];
        return $transformerData;
    }
}
