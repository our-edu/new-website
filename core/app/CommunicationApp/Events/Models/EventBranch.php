<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Events\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Models\Branch;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventBranch extends Pivot
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'events_branches';

    /**
     * @var string[]
     */
    protected $fillable = [
        'event_uuid',
        'branch_uuid',
    ];

    /**
     * @return BelongsTo
     */
    public function event() : BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_uuid');
    }

    /**
     * @return BelongsTo
     */
    public function branch() : BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_uuid');
    }
}
