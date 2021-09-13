<?php

declare(strict_types = 1);

namespace App\BoilerplateApp\Applications\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Models\Student;
use App\BoilerplateApp\Classrooms\Models\ClassRoom;
use App\BaseApp\Models\UploadedMedia;
use App\BaseApp\Traits\Uuids;
use App\BoilerplateApp\Bills\Models\Bill;
use App\BoilerplateApp\Grades\Models\Grade;
use App\BoilerplateApp\AcademicYears\Models\AcademicYear;
use App\BoilerplateApp\Branches\Models\Branch;
use App\BoilerplateApp\EducationalSystems\Models\EducationalSystem;
use App\BoilerplateApp\InterviewAppointments\Models\InterviewAppointment;
use App\BoilerplateApp\Register\Models\ParentUser;
use App\BoilerplateApp\Register\Models\RegistrationAttachment;
use App\BoilerplateApp\Semesters\Models\Semester;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChildApplication extends BaseModel
{
    use  Uuids, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'applications';

    protected $morphClass = 'applications';

    /**
     * @var string[]
     */
    protected $fillable = [
        'parent_id',
        'academic_year_id',
        'grade_id',
        'educational_system_id',
        'branch_id',
        'gender',
        'first_name',
        'last_name',
        'image_uuid',
        'national_id',
        'class_uuid',
        'birthdate',
        'notes',
        'payment_method_uuid',

    ];

    /**
     * @return HasMany
     *
     * @psalm-return HasMany<>
     */
    public function statuses(): HasMany
    {
        return $this->hasMany(ApplicationStatus::class, 'application_id', 'uuid');
    }

    /**
     */
    public function currentStatus(): HasMany
    {
        return $this->hasMany(ApplicationStatus::class, 'application_id', 'uuid')->orderByDesc('created_at');
    }
    
    public function lastStatus(): HasOne
    {
        return $this->hasOne(ApplicationStatus::class, 'application_id')->orderByDesc('created_at');
    }

    public function childImage(): BelongsTo
    {
        return $this->belongsTo(UploadedMedia::class, 'image_uuid');
    }

    public function attachments(): BelongsToMany
    {
        return $this->belongsToMany(UploadedMedia::class, 'application_attachments', 'application_uuid', 'uploaded_media_uuid');
    }

    public function paymentAttachments(): BelongsToMany
    {
        return $this->belongsToMany(UploadedMedia::class, 'application_payment_attachments', 'application_uuid', 'uploaded_media_uuid');
    }

    public function getChildNameAttribute(): string
    {
        return $this->getAttributeValue('first_name') . " " . $this->getAttributeValue('last_name');
    }

    /***
     * @return HasOne
     */

//    public function interview() : HasOne
//    {
//        return $this->hasOne(InterviewAppointment::class, 'application_uuid');
//    }
    /**
     * @return bool
     */
//    public function hasInterview() : bool
//    {
//        return $this->interview()->exists();
//    }


    /**
     * @return bool
     */
    public function hasBill() :  bool
    {
        return $this->bill()->exists();
    }

    /**
     * @return MorphOne
     */

    public function serviceOrder() : MorphOne
    {
         return $this->morphOne(ServiceOrder::class, 'serviceable');
    }

    public function paymentMethod() : BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_uuid');
    }

    public function busRoute() : HasOne
    {
        return $this->hasOne(ApplicationBusRoute::class, 'application_uuid');
    }
    public function paymentAttachment() : HasOne
    {
        return $this->hasOne(ApplicationPaymentAttachment::class, 'application_uuid');
    }
}
