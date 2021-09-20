<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Models\Branch;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnnouncementBranch extends Pivot
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'announcements_branches';

    /**
     * @var string[]
     */
    protected $fillable = [
        'announcement_uuid',
        'branch_uuid',
    ];

    /**
     * @return BelongsTo
     */
    public function announcement() : BelongsTo
    {
        return $this->belongsTo(Announcement::class, 'announcement_uuid');
    }

    /**
     * @return BelongsTo
     */
    public function branch() : BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_uuid');
    }
}
