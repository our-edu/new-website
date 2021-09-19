<?php

declare(strict_types = 1);

namespace App\BaseApp\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Traits\HasBranch;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchTranslation extends BaseModel
{
    use SoftDeletes;
    protected $fillable =[
        'name',

    ];
}
