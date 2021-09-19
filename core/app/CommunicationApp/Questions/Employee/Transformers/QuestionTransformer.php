<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Questions\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\CommunicationApp\Questions\Models\Question;
use League\Fractal\TransformerAbstract;

class QuestionTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
       'actions',
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

    public function transform(Question $question): array
    {
        return [
            'id' => $question->uuid,
            'body' => $question->body,
        ];
    }

    public function includeActions(Question $question)
    {
        $actions[] = [
        'endpoint_url' => buildScopeRoute('api.employee.questions.update', [
            'question' => $question->uuid,
        ]),
        'label' => trans('questions.'.APIActionsEnums::UPDATE_QUESTION),
        'method' => 'PUT',
        'key' => APIActionsEnums::UPDATE_QUESTION
        ];
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.questions.destroy', [
                'question' => $question->uuid,
            ]),
            'label' => trans('questions.'.APIActionsEnums::DELETE_QUESTION),
            'method' => 'DELETE',
            'key' => APIActionsEnums::DELETE_QUESTION
        ];

        if (count($actions)) {
            return $this->collection($actions, new ActionTransformer(), ResourceTypesEnums::ACTION);
        }
    }
}