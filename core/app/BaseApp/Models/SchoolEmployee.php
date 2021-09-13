<?php

declare(strict_types = 1);

namespace App\BaseApp\Models;

;

use App\BaseApp\BaseModel;
use App\BaseApp\Models\User;
use App\RegistrationApp\Branches\Models\Branch;
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
}
