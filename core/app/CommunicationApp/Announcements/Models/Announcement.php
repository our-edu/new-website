<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Enums\AnnouncementStatuses;
use App\BaseApp\Models\Branch;
use App\BaseApp\Models\Role;
use App\BaseApp\Models\UploadedMedia;
use App\BaseApp\Models\User;
use App\BaseApp\Traits\ExportTrait;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends BaseModel
{
    use SoftDeletes , Translatable, ExportTrait;


    /**
     * @var string[]
     */
    protected $fillable = [
        'from',
        'to',
        'publisher_uuid',
        'status',
        'web_image',
        'mobile_image',
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
     * @return BelongsTo
     */
    public function webImage() : BelongsTo
    {
        return $this->belongsTo(UploadedMedia::class, 'web_image');
    }

    /**
     * @return BelongsTo
     */
    public function mobileImage() : BelongsTo
    {
        return $this->belongsTo(UploadedMedia::class, 'mobile_image');
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

        $today = Carbon::today()->toDate()->format('Y-m-d');
        return $this->attributes['from'] > $today ?
            trans('enums.AnnouncementStatuses.'.AnnouncementStatuses::PENDING) :
            ($this->attributes['from'] <= $today && $this->attributes['to'] >= $today ?
                trans('enums.AnnouncementStatuses.'.AnnouncementStatuses::ACTIVE) :
                trans('enums.AnnouncementStatuses.'.AnnouncementStatuses::EXPIRED)
            );
    }

    /**
     * @param $data
     * @return array
     */
    protected function exportedData($data)
    {
        $branchesName = '';
        foreach ($data->branches as $index => $branch) {
            if ($index != 0) {
                $branchesName .= ', ';
            }
            $branchesName .= $branch->name;
        }
        $rolesName = '';
        foreach ($data->roles as $index => $role) {
            if ($index != 0) {
                $rolesName .= ', ';
            }
            $rolesName .= $role->display_name;
        }
        return [

            trans('export.Announcement.Title') => $data->title,
            trans('export.Announcement.Publish_At') => $data->from,
            trans('export.Announcement.End_Publish_At') => $data->to,
            trans('export.Announcement.body') => $data->body,
            trans('export.Announcement.school_Branch') => $branchesName,
            trans('export.Announcement.Added_at') => $data->created_at,
            trans('export.Announcement.Published_by') => $data->publisher->name,
            trans('export.Announcement.Displayed_to_Types') => $rolesName,
            trans('export.Announcement.Status') => $data->getPublishStatus(),
        ];
    }
}
