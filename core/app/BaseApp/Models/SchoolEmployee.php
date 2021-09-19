<?php

declare(strict_types = 1);

namespace App\BaseApp\Models;

;

use App\BaseApp\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SchoolEmployee extends BaseModel
{
    protected $fillable = [
        'branch_id',
        'user_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function branch() :BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    /**
     * @return BelongsToMany
     */
    public function branches() :BelongsToMany
    {
        return $this->belongsToMany(Branch::class, 'branches_employees', "employee_id", "branch_id");
    }
}
