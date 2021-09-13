<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Models;

use App\BaseApp\BaseModel;
use App\BoilerplateApp\Grades\Models\Grade;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceOrder extends BaseModel
{

    protected $table = 'service_orders';
    protected $fillable = [
        'total',
        'status',
        'vat',
        'total_with_vat'
    ];

    public function serviceable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsToMany
     */

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'service_order_items', 'service_order_uuid', 'service_uuid')->withPivot(['price','vat','price_with_vat','service_grade_uuid']);
    }

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(ServiceOrderItem::class, 'service_order_uuid');
    }
}
