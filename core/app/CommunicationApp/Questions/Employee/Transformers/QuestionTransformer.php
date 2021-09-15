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
       // 'actions',
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
//        $actions[] = [
//            'endpoint_url' => buildScopeRoute('api.admin.educational-systems.update', [
//                'educational_system' => $educationalSystem->uuid,
//            ]),
//            'label' => trans('educational-systems.update-educational-systems'),
//            'method' => 'PUT',
//            'key' => APIActionsEnums::UPDATE_EDUCATIONAL_SYSTEM
//        ];


        if (count($actions)) {
            return $this->collection($actions, new ActionTransformer(), ResourceTypesEnums::ACTION);
        }
    }
}
