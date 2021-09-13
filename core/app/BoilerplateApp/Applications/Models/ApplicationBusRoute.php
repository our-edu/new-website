<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Models;

use App\BaseApp\BaseModel;

class ApplicationBusRoute extends BaseModel
{


    protected $table = 'application_bus_routes';

    protected $fillable = [
        'application_uuid',
        'bus_route_uuid',

    ];
}
