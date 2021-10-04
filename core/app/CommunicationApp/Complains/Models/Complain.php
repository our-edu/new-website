<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Models\ParentUser;
use App\BaseApp\Models\Student;
use App\BaseApp\Traits\ExportTrait;
use App\CommunicationApp\Complains\Enums\ComplainStatusesEnum;
use App\CommunicationApp\Questions\Models\QuestionAnswers;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complain extends BaseModel
{
    use SoftDeletes, ExportTrait;

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
        'procedure',
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
        return $this->belongsTo(ParentUser::class, 'parent_uuid', 'uuid');
    }

    /**
     * @return BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_uuid', 'uuid');
    }

    /**
     * @return HasMany
     */
    public function questionsAnswers(): HasMany
    {
        return $this->hasMany(QuestionAnswers::class, 'complain_uuid');
    }

    /**
     * @param $data
     * @return array
     */
    protected function exportedData($data)
    {
        return [
            'Parent Name' => $data->parent->user->name,
            'Parent National Id ' => $data->parent->user->national_id,
            'Title' => $data->title,
            'Child name' => $data->student->user->name,
            'Body' => $data->body,
            'Status' => ComplainStatusesEnum::getStatuses()[$data->status][app()->getLocale()],
            'Sent date and time' => $data->created_at,
            'Resolution Date' => $data->statuses()->where('name', ComplainStatusesEnum::RESOLVED_EN)->latest()->first()->created_at ?? 'not resolved',
        ];
    }
}
