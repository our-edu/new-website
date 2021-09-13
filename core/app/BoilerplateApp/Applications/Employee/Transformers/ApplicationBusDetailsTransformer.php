<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Employee\Transformers;

use App\BoilerplateApp\Applications\Models\ChildApplication;
use League\Fractal\TransformerAbstract;

class ApplicationBusDetailsTransformer extends TransformerAbstract
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

    /**
     * @param ChildApplication $childApplication
     * @return array (mixed|string)[]
     * @psalm-return array{bus_number: mixed, driver_mobile: mixed, driver_name: mixed, id: string, supervisor_mobile: mixed|null, supervisor_name: mixed|null}
     */
    public function transform(ChildApplication $childApplication): array
    {

        $transformerData = [
            'id' => $childApplication->uuid,
            'bus_number' => $childApplication->busRoute->busRoute->bus->plate_number,
            'driver_name' => $childApplication->busRoute->busRoute->bus->driver->user->name,
            'driver_mobile' => $childApplication->busRoute->busRoute->bus->driver->user->mobile,
            "supervisor_name" =>  $childApplication->busRoute->busRoute->bus->supervisor()->exists() ?  $childApplication->busRoute->busRoute->bus->supervisor->user->name : null,
            "supervisor_mobile" => $childApplication->busRoute->busRoute->bus->supervisor()->exists() ?  $childApplication->busRoute->busRoute->bus->supervisor->user->mobile : null,
        ];
        return $transformerData;
    }
}
