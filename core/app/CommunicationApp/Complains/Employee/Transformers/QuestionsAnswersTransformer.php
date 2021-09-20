<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\CommunicationApp\Questions\Models\QuestionAnswers;
use League\Fractal\TransformerAbstract;

class QuestionsAnswersTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
    ];
    protected $availableIncludes = [
    ];

    /**
     * @var array|mixed
     */
    private $params;

    public function __construct($params = [])
    {
        $this->params = $params;
    }

    public function transform(QuestionAnswers $questionAnswer): array
    {
        return [
            'id' => $questionAnswer->uuid,
            'question' => $questionAnswer->question->body,
            'answer' => $questionAnswer->value,
            'parent' => $questionAnswer->parent->user->name,
            'complain' => $questionAnswer->complain->title,
        ];
    }

   }
