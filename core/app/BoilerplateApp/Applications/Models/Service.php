<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Models;

use App\BaseApp\BaseModel;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends BaseModel
{
    use Translatable;

    protected $table = 'services';

    protected $fillable = [
        'show',
        'mandatory',
        'branch_uuid',
        'slug',
        'type'
    ];

    protected $translatedAttributes = [
        'name',
    ];


    protected $with = [
        'translations'
    ];

    public function serviceGrades() : HasMany
    {
        return  $this->hasMany(ServiceGrade::class, 'service_uuid');
    }
}
