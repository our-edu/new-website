<?php

declare(strict_types = 1);

namespace App\BaseApp\Models;

use App\BaseApp\Traits\Uuids;
use App\CommunicationApp\Announcements\Models\Announcement;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Role extends SpatieRole
{

    use HasSlug ,Translatable;
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

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name', 'branch_uuid'])
            ->saveSlugsTo('slug')
            ->usingSeparator('_');
    }
    public function setNameAttribute($value)
    {
        if($this->branch_uuid){
            $this->attributes['name'] = $value . "_" . $this->branch_uuid;
        }else{
            $this->attributes['name'] = $value;
        }

    }

    /**
     * @return BelongsToMany
     */
    public function announcements() : BelongsToMany
    {
        return $this->belongsToMany(Announcement::class, 'announcements_roles', 'role_id', 'announcement_uuid');
    }


}
