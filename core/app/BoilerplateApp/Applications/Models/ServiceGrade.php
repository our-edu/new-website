<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Models;

use App\BaseApp\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ServiceGrade extends BaseModel
{


    protected $table = 'services_grades';

    protected $fillable = [
        'cost',
        'grade_uuid',
        'service_uuid',
        'service_grade_uuid'
    ];

    protected $with = [
        'service',
        'semester',
        'semesters'
    ];




    public function service() : BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_uuid');
    }

    public function semester() : HasOne
    {
        return $this->hasOne(ServiceGradeSemester::class, 'service_grade_uuid');
    }
}
