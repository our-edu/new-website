<?php

declare(strict_types = 1);

namespace App\BaseApp\Models;

use App\BaseApp\BaseModel;
use Astrotomic\Translatable\Translatable;

class Location extends BaseModel
{
    use Translatable;
    protected $fillable = ['longitude', 'latitude', 'related_id', 'related_type'];
    public $translationModel = LocationTranslation::class;

    protected $translatedAttributes = [
        'address'
    ];

    public function related()
    {
        return $this->morphTo();
    }
}
