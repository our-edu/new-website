<?php

declare(strict_types = 1);

namespace App\BaseApp\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Traits\CreatedBy;
use App\BaseApp\Traits\Uuids;

class Meta extends BaseModel
{
    protected $fillable = [
       'meta_keys',
        'meta_description'
    ];

 /**
  * @return \Illuminate\Database\Eloquent\Relations\MorphTo
  */
    public function metable()
    {
        return $this->morphTo();
    }
}
