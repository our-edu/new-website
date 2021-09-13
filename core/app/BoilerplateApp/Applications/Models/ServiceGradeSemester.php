<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ServiceGradeSemester extends Pivot
{


    protected $table = 'service_grade_semesters';

    protected $fillable = [
        'service_grade_uuid',
        'semester_uuid'
    ];
    protected $with = [
        'semester'
    ];
}
