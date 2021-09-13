<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Models\User;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceTranslation extends BaseModel
{
    protected $table = 'service_translations';

    protected $fillable = [
        'name',
    ];
}
