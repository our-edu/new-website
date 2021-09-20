<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Questions\Models;

use App\BaseApp\BaseModel;
use App\BaseApp\Models\ParentUser;
use App\CommunicationApp\Complains\Models\Complain;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionAnswers extends BaseModel
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'complains_questions_answers';

    /**
     * @var string[]
     */
    protected $fillable =[
        'value',
        'complain_uuid',
        'parent_uuid',
        'question_uuid'
        ];

    /**
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_uuid');
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(ParentUser::class, 'parent_uuid');
    }

    /**
     * @return BelongsTo
     */
    public function complain(): BelongsTo
    {
        return $this->belongsTo(Complain::class, 'complain_uuid');
    }
}
