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
use Exception;
use Illuminate\Http\JsonResponse;
use Log;

class ReportsController extends BaseApiController
{

    protected string $ActivityReportResourceType = ResourceTypesEnums::PARENT_ACTIVITY_REPORT;


    /**
     * @return array|array[]|JsonResponse
     */
    public function index()
    {
        $complains = $t->with('questionsAnswers')->paginate();
        return $this->transformDataModInclude($complains, '', new  ListComplainsTransformer(), $this->ResourceType);
    }

}
