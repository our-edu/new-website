<?php

namespace App\CommunicationApp\Complains\Models;

use App\BaseApp\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionTranslation extends BaseModel
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'question_translations';

    /**
     * @var string[]
     */
    protected $fillable = [
        'body'
    ];

}