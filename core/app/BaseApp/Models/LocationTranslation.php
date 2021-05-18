<?php

declare(strict_types = 1);

namespace App\BaseApp\Models;

use App\BaseApp\BaseModel;

class LocationTranslation extends BaseModel
{
    protected $table = "location_translations";
    protected $fillable = [
        'address',
    ];
}
