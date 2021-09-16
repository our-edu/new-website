<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Models;

use App\BaseApp\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complain extends BaseModel
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'complains';
    /**
     * @var string[]
     */
    protected $fillable = [
        'parent_uuid',
        'student_uuid',
        'body',
        'status'
    ];

    /**
     * @return HasMany
     */
    public function statuses(): HasMany
    {
        return $this->hasMany(ComplainStatus::class, 'complain_uuid', 'uuid');
    }
}
