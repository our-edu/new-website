<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Models\ParentUser;
use App\BaseApp\Models\Student;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'title',
        'status'
    ];

    /**
     * @return HasMany
     */
    public function statuses(): HasMany
    {
        return $this->hasMany(ComplainStatus::class, 'complain_uuid', 'uuid');
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(ParentUser::class, 'parent_uuid','uuid');
    }

    /**
     * @return BelongsTo
     */
    public  function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_uuid','uuid');
    }
}
