<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Questions\Models;

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