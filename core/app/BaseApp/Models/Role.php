<?php

declare(strict_types = 1);

namespace App\BaseApp\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{

    use Translatable;
    protected $primaryKey = 'id';
    public $keyType = 'string';
    public $incrementing = false;
    public $guard_name = 'api';
    /**
     * Translation Model
     */
    public $translationModel = RoleTranslation::class;
    /**
     * translatable Attributes
     * @var string[]
     */
    protected $translatedAttributes = [
        'display_name'
    ];


    public static function boot()
    {
        parent::boot();
        static::creating(function ($role) {
            $role->id = Uuid::uuid4()->toString();
        });
    }

    public function setNameAttribute($value)
    {
        if (isset($this->attributes['branch_uuid'])) {
            $this->attributes['name'] = $value . "_" . $this->attributes['branch_uuid'];
        } else {
            $this->attributes['name'] = $value;
        }
    }
    /**
     * @return BelongsTo
     */
    public function branch() : BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_uuid');
    }
}
