<?php

declare(strict_types = 1);

namespace App\BaseApp;

use App\BaseApp\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory, Uuids;
    protected $primaryKey = 'uuid';
    public $keyType = 'uuid';
    public $incrementing = false;
//    protected $guarded = [
//        'uuid'
//    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
