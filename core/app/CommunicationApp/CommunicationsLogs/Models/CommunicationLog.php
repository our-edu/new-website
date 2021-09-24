<?php

declare(strict_types = 1);

namespace App\CommunicationApp\CommunicationsLogs\Models;

use App\BaseApp\Models\Branch;
use App\BaseApp\Models\ParentUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunicationLog extends \App\BaseApp\BaseModel
{

    use SoftDeletes;
    protected $table = 'communications_log';
    /**
     * @var string[]
     */
    protected $fillable = [
        'type',
        'reason',
        'parent_uuid',
        'date',
        'procedure',
        'branch_uuid'
    ];

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(ParentUser::class, 'parent_uuid');
    }

    /**
     * @return BelongsTo
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_uuid');
    }
}
