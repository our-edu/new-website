<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Questions\Models;

use App\BaseApp\BaseModel;
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
}
