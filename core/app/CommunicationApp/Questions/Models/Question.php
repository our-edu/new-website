<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Questions\Models;

use App\BaseApp\BaseModel;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends BaseModel
{
    use SoftDeletes , Translatable;

    /**
     * @var string
     */
    protected $table = 'questions';


    /**
     * @var string[]
     */
    protected $fillable = [
        'active'
    ];

    /**
     * @var string
     */
    public $translationModel = QuestionTranslation::class;

    /**
     * @var array|string[]
     */
    protected array $translatedAttributes = [
        'body'
    ];

    /**
     * @return HasOne
     */
    public function answer(): HasOne
    {
        return $this->hasOne(QuestionAnswers::class, 'question_uuid', 'uuid');
    }
}
