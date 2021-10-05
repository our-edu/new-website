<?php

declare(strict_types = 1);

namespace App\CommunicationApp\CommunicationsLogs\Calls\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\CommunicationApp\CommunicationsLogs\Models\CommunicationLog;
use League\Fractal\TransformerAbstract;

class ListCallsTransformer extends TransformerAbstract
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

    public function transform(CommunicationLog $call): array
    {
        return [
            'id' => $call->uuid,
            'reason' => $call->reason,
            'parent' => $call->parent->user->name,
            'date' => $call->date,
            'procedure' => $call->procedure,
            'datetime' => $call->date,
            'branch' => $call->branch->name
        ];
    }

    public function includeActions(CommunicationLog $call)
    {
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.calls.show', [
                'call' => $call->uuid,
            ]),
            'label' => trans('calls.'.APIActionsEnums::SHOW_CALL),
            'method' => 'GET',
            'key' => APIActionsEnums::SHOW_CALL
        ];
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.calls.update', [
                'call' => $call->uuid,
            ]),
            'label' => trans('calls.'.APIActionsEnums::UPDATE_CALL),
            'method' => 'PUT',
            'key' => APIActionsEnums::UPDATE_CALL
        ];
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.calls.destroy', [
                'call' => $call->uuid,
            ]),
            'label' => trans('calls.'.APIActionsEnums::DELETE_CALL),
            'method' => 'DELETE',
            'key' => APIActionsEnums::DELETE_CALL
        ];


        if (count($actions)) {
            return $this->collection($actions, new ActionTransformer(), ResourceTypesEnums::ACTION);
        }
    }
}
