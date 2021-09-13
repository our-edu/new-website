<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationStatus extends BaseModel
{
    use  Uuids,SoftDeletes;

    protected $table = 'application_status';

    protected $fillable = [
        'application_id',
        'status',
        'reason',
    ];
}
