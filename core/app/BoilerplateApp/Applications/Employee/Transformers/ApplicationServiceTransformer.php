<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Employee\Transformers;

use App\BoilerplateApp\Applications\Models\Service;
use League\Fractal\TransformerAbstract;

class ApplicationServiceTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [

        ];
    protected $availableIncludes = [
    ];

    private $params;

    public function __construct($params = [])
    {
        $this->params = $params;
    }

    public function transform(Service $service)
    {
        $transformerData = [
            'id' => $service->uuid,
            'name' => $service->translate(app()->getLocale())->name ?? '',
            'type' => $service->type ?? '',
            'mandatory' => $service->mandatory,
            'show' => $service->show,
            'cost'=>$service->pivot->price
        ];
        return $transformerData;
    }
}
