<?php

declare(strict_types = 1);

namespace App\BaseApp\Models;

use App\BaseApp\Traits\Uuids;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected $primaryKey = 'id';
    public $keyType = 'string';
    public $incrementing = false;
    public $guard_name = 'api';

    public static function boot()
    {
        parent::boot();
        static::creating(function ($permission) {
            $permission->id = Uuid::uuid4()->toString();
        });
    }
}
