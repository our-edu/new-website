<?php

declare(strict_types = 1);

namespace App\BaseApp\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        "pocket_money",
        'academic_year_id',
        'grade_class_id',
        'educational_system_id',
        'class_id',
        'semester_id',
        'school_id',
        'user_id',
        'birth_date',
        'attachments',
        'notes',
        'branch_id',
        'application_id'

    ];


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function parents() :BelongsToMany
    {
        return $this->belongsToMany(ParentUser::class, 'parent_student', 'student_uuid', 'parent_uuid');
    }
}
