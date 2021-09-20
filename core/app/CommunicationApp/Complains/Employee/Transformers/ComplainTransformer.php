<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\CommunicationApp\Complains\Enums\ComplainStatusesEnum;
use App\CommunicationApp\Complains\Models\Complain;
use League\Fractal\TransformerAbstract;

class ComplainTransformer extends TransformerAbstract
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

    public function transform(Complain $complain): array
    {
        return [
            'id' => $complain->uuid,
            'title' => $complain->title,
            'body' => $complain->body,
            'status' => $complain->status,
            'parent' => $complain->parent->user->name,
            'student' => $complain->student->user->name
        ];
    }

    public function includeActions(Complain $complain)
    {
        $actions = [];
        if($complain->status != ComplainStatusesEnum::RESOLVED_EN){

            $actions[] = [
                'endpoint_url' => buildScopeRoute('api.employee.complains.resolve', [
                    'complain' => $complain->uuid,
                ]),
                'label' => trans('questions.' . APIActionsEnums::RESOLVE_COMPLAIN),
                'method' => 'PUT',
                'key' => APIActionsEnums::RESOLVE_COMPLAIN
            ];
        }

        if (count($actions)) {
            return $this->collection($actions, new ActionTransformer(), ResourceTypesEnums::ACTION);
        }
    }
}
