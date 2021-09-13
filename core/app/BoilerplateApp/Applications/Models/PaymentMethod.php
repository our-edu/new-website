<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Models;

use App\BaseApp\BaseModel;
use App\BoilerplateApp\Grades\Models\Grade;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends BaseModel
{
    use Translatable;

    protected $table = 'payment_methods';

    protected $translatedAttributes = [
        'name',
    ];
    protected $fillable = [
        'type',
        'name'

    ];
}
