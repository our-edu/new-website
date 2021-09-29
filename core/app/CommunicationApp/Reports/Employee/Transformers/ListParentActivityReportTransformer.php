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

class ListParentActivityReportTransformer extends TransformerAbstract
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
            'id' => $report->parent_uuid,
            'parent' => $report->parent->user->name,
            'complains_count' => $report->complains_count,
            'visits_count' => $report->visits_count,
            'calls_count' => $report->calls_count,
        ];
    }

    public function includeActions(ParentActivityReport $report)
    {
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.reports.parent_activity.show',
                ['parent_uuid'=> $report->parent_uuid]),
            'label' => trans('visits.' . APIActionsEnums::SHOW_PARENT_ACTIVITY_REPORT),
            'method' => 'GET',
            'key' => APIActionsEnums::SHOW_PARENT_ACTIVITY_REPORT
        ];
        $actions[] = [
            'endpoint_url' => buildScopeRoute('api.employee.reports.parent_activity_export'),
            'label' => trans('reports.' . APIActionsEnums::EXPORT_PARENT_ACTIVITY_REPORT),
            'method' => 'GET',
            'key' => APIActionsEnums::EXPORT_PARENT_ACTIVITY_REPORT
        ];

        if (count($actions)) {
            return $this->collection($actions, new ActionTransformer(), ResourceTypesEnums::ACTION);
        }
    }
}
