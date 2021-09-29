<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Reports\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\CommunicationApp\Complains\Employee\Requests\ResolveComplainRequest;
use App\CommunicationApp\Complains\Employee\Transformers\ComplainTransformer;
use App\CommunicationApp\Complains\Employee\Transformers\ListComplainsTransformer;
use App\CommunicationApp\Complains\Enums\ComplainStatusesEnum;
use App\CommunicationApp\Complains\Repository\ComplainRepositoryInterface;
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
    public function parentActivity()
    {
        $parentActivities = ParentActivityReport::with('parent')->paginate();
        return $this->transformDataModInclude($parentActivities, '', new  ParentActivityReportTransformer(), $this->ActivityReportResourceType);
    }
    public function parentActivityExport()
    {
        $parentActivities = ParentActivityReport::with('parent')->get();
        return (new ParentActivityReport)->export($parentActivities,'Parent_Activity_Report');
    }
}
