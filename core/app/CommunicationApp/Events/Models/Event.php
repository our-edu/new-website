<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Events\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Enums\AnnouncementStatuses;
use App\BaseApp\Models\Branch;
use App\BaseApp\Models\Role;
use App\BaseApp\Models\User;
use App\BaseApp\Traits\ExportTrait;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends BaseModel
{
    use SoftDeletes , Translatable, ExportTrait;


    /**
     * @var string[]
     */
    protected $fillable = [
        'creator_uuid',
        'full_day',
        'all_branches',
        'start',
        'end',
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
    public function creator() : BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_uuid');
    }

    /**
     * @return BelongsToMany
     */
    public function branches() : BelongsToMany
    {
        return $this->belongsToMany(Branch::class, 'branches_events', 'event_uuid', 'branch_uuid');
    }

    /**
     * @param $data
     * @return array
     */
    protected function exportedData($data) : array
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
            'Announcement Title' => $data->title,
            'Publish At' => $data->from,
            'End Publish At' => $data->to,
            'school Branch' => $branchesName,
            'Added at' => $data->created_at,
            'Published by' => $data->publisher->name,
            'Displayed to Types' => $rolesName,
            'Status' => $data->getPublishStatus(),
        ];
    }
}
