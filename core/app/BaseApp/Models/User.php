<?php

namespace App\BaseApp\Models;

use App\BaseApp\Traits\CreatedBy;
use App\BaseApp\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Uuids, CreatedBy;

    protected $primaryKey = 'uuid';
    public $incrementing = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'mobile',
        'profile_picture',
        'type',
        'password',
        'status',
        'created_by',
        'national_id',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

}