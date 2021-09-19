<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Parent\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\CommunicationApp\Complains\Models\ComplainStatus;
use League\Fractal\TransformerAbstract;

class ListComplainsTransformer extends TransformerAbstract
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

    public function transform(ComplainStatus $complain): array
    {
        return [
            'id' => $complain->uuid,
            'parent' => $complain->parent->user->name,
            'student' => $complain->student->user->name,
            'body' => $complain->body,
            'status' => $complain->status
        ];
    }

    public function includeActions(ComplainStatus $complain)
    {
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.parent.complains.show', [
                'complain' => $complain->uuid,
            ]),
            'label' => trans('questions.'.APIActionsEnums::SHOW_COMPLAIN),
            'method' => 'GET',
            'key' => APIActionsEnums::SHOW_COMPLAIN
        ];


        if (count($actions)) {
            return $this->collection($actions, new ActionTransformer(), ResourceTypesEnums::ACTION);
        }
    }
}
