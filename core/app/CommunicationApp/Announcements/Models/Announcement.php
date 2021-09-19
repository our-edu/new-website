<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Models\Branch;
use App\BaseApp\Models\Role;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends BaseModel
{
    use SoftDeletes , Translatable;


    /**
     * @var string[]
     */
    protected $fillable = [
        'from',
        'to',
        'status'
    ];

    /**
     * @var array|string[]
     */
    protected array $translatedAttributes = [
        'title', 'body'
    ];

    /**
     * @return BelongsToMany
     */
    public function branches() : BelongsToMany
    {
        return $this->belongsToMany(Branch::class, 'announcements_branches', 'announcement_uuid', 'branch_uuid');
    }

    /**
     * @return BelongsToMany
     */
    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'announcements_roles', 'announcement_uuid', 'role_id');
    }
}
