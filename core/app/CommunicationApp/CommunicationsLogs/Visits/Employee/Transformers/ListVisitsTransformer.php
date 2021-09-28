<?php

declare(strict_types = 1);

namespace App\CommunicationApp\CommunicationsLogs\Visits\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\CommunicationApp\CommunicationsLogs\Models\CommunicationLog;
use League\Fractal\TransformerAbstract;

class ListVisitsTransformer extends TransformerAbstract
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

    public function transform(CommunicationLog $visit): array
    {
        return [
            'id' => $visit->uuid,
            'reason' => $visit->reason,
            'parent' => $visit->parent->user->name,
            'date' => $visit->date,
            'branch' => $visit->branch->name
        ];
    }

    public function includeActions(CommunicationLog $visit)
    {
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.visits.show', [
                'visit' => $visit->uuid,
            ]),
            'label' => trans('visits.'.APIActionsEnums::SHOW_VISIT),
            'method' => 'GET',
            'key' => APIActionsEnums::SHOW_VISIT
        ];
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.visits.update', [
                'visit' => $visit->uuid,
            ]),
            'label' => trans('visits.'.APIActionsEnums::UPDATE_VISIT),
            'method' => 'PUT',
            'key' => APIActionsEnums::UPDATE_VISIT
        ];
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.visits.destroy', [
                'visit' => $visit->uuid,
            ]),
            'label' => trans('visits.'.APIActionsEnums::DELETE_VISIT),
            'method' => 'DELETE',
            'key' => APIActionsEnums::DELETE_VISIT
        ];


        if (count($actions)) {
            return $this->collection($actions, new ActionTransformer(), ResourceTypesEnums::ACTION);
        }
    }
}