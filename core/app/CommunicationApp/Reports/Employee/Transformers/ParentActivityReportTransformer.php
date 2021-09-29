<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Reports\Employee\Transformers;

use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Api\Transformers\ActionTransformer;
use App\BaseApp\Traits\Uuids;
use App\CommunicationApp\Complains\Enums\ComplainStatusesEnum;
use App\CommunicationApp\Complains\Models\Complain;
use App\CommunicationApp\Reports\Models\ParentActivityReport;
use League\Fractal\TransformerAbstract;
use Ramsey\Uuid\Nonstandard\Uuid;

class ParentActivityReportTransformer extends TransformerAbstract
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

    public function transform(ParentActivityReport $report): array
    {
        return [
            'id' => Uuid::uuid4()->toString(),
            'parent' => $report->parent->user->name,
            'complains_count' => $report->complains_count,
            'visits_count' => $report->visits_count,
            'calls_count' => $report->calls_count,
        ];
    }

    public function includeActions( )
    {
        $actions[] = [
                'endpoint_url' => buildScopeRoute('api.employee.complains.index'),
                'label' => trans('complains.' . APIActionsEnums::LIST_COMPLAINS),
                'method' => 'GET',
                'key' => APIActionsEnums::LIST_COMPLAINS
        ];
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.calls.index'),
            'label' => trans('calls.' . APIActionsEnums::LIST_CALLS),
            'method' => 'GET',
            'key' => APIActionsEnums::LIST_CALLS
        ];
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.visits.index'),
            'label' => trans('visits.' . APIActionsEnums::LIST_VISITS),
            'method' => 'GET',
            'key' => APIActionsEnums::LIST_VISITS
        ];
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.parent_activity_export'),
            'label' => trans('reports.' . APIActionsEnums::EXPORT_PARENT_ACTIVITY_REPORT),
            'method' => 'GET',
            'key' => APIActionsEnums::EXPORT_PARENT_ACTIVITY_REPORT
        ];

        if (count($actions)) {
            return $this->collection($actions, new ActionTransformer(), ResourceTypesEnums::ACTION);
        }
    }

}
