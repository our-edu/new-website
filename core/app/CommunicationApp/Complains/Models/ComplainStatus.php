<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplainStatus extends BaseModel
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'complain_statuses';
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'complain_uuid',
        'user_uuid',
        'reason'
    ];

    /**
     * @return BelongsTo
     */
    public function complain(): BelongsTo
    {
        return $this->belongsTo(Complain::class, 'complain_uuid');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_uuid');
    }
}
