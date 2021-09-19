<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Models\Branch;
use App\BaseApp\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnnouncementRole extends Pivot
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'announcements_roles';

    /**
     * @var string[]
     */
    protected $fillable = [
        'announcement_uuid',
        'role_id',
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
    public function role() : BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
