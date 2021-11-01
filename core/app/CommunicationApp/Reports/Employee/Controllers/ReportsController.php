<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Reports\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\CommunicationApp\Complains\Employee\Requests\ResolveComplainRequest;
use App\CommunicationApp\Complains\Employee\Transformers\ComplainTransformer;
use App\CommunicationApp\Complains\Employee\Transformers\ListComplainsTransformer;
use App\CommunicationApp\Complains\Enums\ComplainStatusesEnum;
use App\CommunicationApp\Complains\Repository\ComplainRepositoryInterface;
use App\CommunicationApp\Reports\Employee\Transformers\ListParentActivityReportTransformer;
use App\CommunicationApp\Reports\Employee\Transformers\ParentActivityReportTransformer;
use App\CommunicationApp\Reports\Models\ParentActivityReport;
use Exception;
use Illuminate\Http\JsonResponse;
use Log;

class ReportsController extends BaseApiController
{

    protected string $ActivityReportResourceType = ResourceTypesEnums::PARENT_ACTIVITY_REPORT;


    /**
     * @return array|array[]|JsonResponse
     */
    public function parentActivityList()
    {
        $employee_branch_uuid = auth('api')->user()->schoolEmployee->branch_id;
        $parentActivities = ParentActivityReport::with('parent')->where('branch', $employee_branch_uuid)->paginate();
        return $this->transformDataModInclude($parentActivities, '', new  ListParentActivityReportTransformer(), $this->ActivityReportResourceType, $this->defaultIncludes());
    }
    /**
     * @return array|array[]|JsonResponse
     */
    public function parentActivityShow($parent_uuid)
    {
        $employee_branch_uuid = auth('api')->user()->schoolEmployee->branch_id;
        $parentActivities = ParentActivityReport::with('parent')->where('parent_uuid', $parent_uuid)->where('branch', $employee_branch_uuid)->paginate();
        return $this->transformDataModInclude($parentActivities, '', new  ParentActivityReportTransformer(), $this->ActivityReportResourceType);
    }

    public function parentActivityExport()
    {
        $employee_branch_uuid = auth('api')->user()->schoolEmployee->branch_id;
        $parentActivities = ParentActivityReport::with('parent')->where('branch', $employee_branch_uuid)->paginate();
        return (new ParentActivityReport)->export($parentActivities, 'Parent_Activity_Report');
    }
    private function defaultIncludes(): array
    {
        $actions[APIActionsEnums::EXPORT_PARENT_ACTIVITY_REPORT] = [
            'endpoint_url' => buildScopeRoute('api.employee.reports.parent_activity_export'),
            'label' => trans('enums.APIActionsEnums.' . APIActionsEnums::EXPORT_PARENT_ACTIVITY_REPORT),
            'method' => 'GET',
            'key' => APIActionsEnums::EXPORT_PARENT_ACTIVITY_REPORT
        ];
        return ['default_actions' => $actions];
    }
}
