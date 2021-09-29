<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Questions\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\CommunicationApp\Questions\Models\Question;
use App\CommunicationApp\Settings\Employee\Transformers\SettingsTransformer;
use App\CommunicationApp\Settings\model\GeneralSettings;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class ListQuestionsTransformer extends TransformerAbstract
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
            'body_en' => $question->translate('en')->body,
            'body_ar' => $question->translate('ar')->body,
            'active' => $question->active
        ];
    }

    public function includeActions(Question $question)
    {
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.questions.show', [
                'question' => $question->uuid,
            ]),
            'label' => trans('questions.'.APIActionsEnums::SHOW_QUESTION),
            'method' => 'GET',
            'key' => APIActionsEnums::SHOW_QUESTION
        ];

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
