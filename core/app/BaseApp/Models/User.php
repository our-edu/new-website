<?php

declare(strict_types = 1);

namespace App\BaseApp\Models;

use App\BaseApp\Traits\CreatedBy;
use App\BaseApp\Traits\Uuids;
use App\CommunicationApp\Announcements\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Uuids, CreatedBy , HasRoles;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    public $guard_name = 'api';
    public $keyType = 'uuid';

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

    /**
     * @return string
     */

    public function getNameAttribute(): string
    {
        return "{$this->getAttributeValue('first_name')} {$this->getAttributeValue('last_name')}";
    }

    /**
     * @return HasMany
     */
    public function announcements() : HasMany
    {
        return $this->hasMany(Announcement::class, 'publisher_uuid');
    }

    /**
     * @return BelongsTo
     */

    public function profilePicture(): BelongsTo
    {
        return $this->belongsTo(UploadedMedia::class, 'profile_picture');
    }

//    /**
//     * get User Parent Data
//     * @return HasOne
//     */
//
//    public function parent(): HasOne
//    {
//        return $this->hasOne(ParentUser::class, 'user_uuid');
//    }

    /**
     * @return HasOne
     */

    public function schoolEmployee() : HasOne
    {
        return $this->hasOne(SchoolEmployee::class, 'user_id');
    }

    /**
     * @return MorphToMany
     */
    public function userRole() : MorphToMany
    {
        return $this->morphToMany(Role::class, 'model', 'model_has_roles', 'model_uuid');
    }
    /**
     * get User Parent Data
     * @return HasOne
     */

    public function parent(): HasOne
    {
        return $this->hasOne(ParentUser::class, 'user_uuid');
    }
    public function student() :  HasOne
    {
        return $this->hasOne(Student::class, 'user_id');
    }
}
