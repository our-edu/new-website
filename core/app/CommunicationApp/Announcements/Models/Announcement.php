<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Enums\AnnouncementStatuses;
use App\BaseApp\Models\Branch;
use App\BaseApp\Models\Role;
use App\BaseApp\Models\User;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
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
        'publisher_uuid',
        'status',
    ];

    /**
     * @var array|string[]
     */
    protected array $translatedAttributes = [
        'title', 'body'
    ];

    /**
     * @return BelongsTo
     */
    public function publisher() : BelongsTo
    {
        return $this->belongsTo(User::class, 'publisher_uuid');
    }

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

    public function getPublishStatus()
    {
        return $this->attributes['from'] > Carbon::now() ?
            trans('announcements.'.AnnouncementStatuses::PENDING) :
            ($this->attributes['from'] <= Carbon::now() && $this->attributes['to'] >= Carbon::now() ?
                trans('announcements.'.AnnouncementStatuses::ACTIVE) :
                trans('announcements.'.AnnouncementStatuses::EXPIRED));
    }
}
