<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Models;

use App\BaseApp\BaseModel;
use App\BoilerplateApp\Grades\Models\Grade;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceOrderItem extends BaseModel
{


    protected $table = 'service_order_items';
    protected $fillable = [
        'service_order_uuid',
        'service_uuid',
        'price',
        'vat',
        'price_with_vat',
        'service_grade_uuid'
    ];

    /**
     * @return BelongsTo
     */
    public function service() : BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_uuid');
    }

    public function serviceGrade() : BelongsTo
    {
        return $this->belongsTo(ServiceGrade::class, 'service_grade_uuid');
    }
}
