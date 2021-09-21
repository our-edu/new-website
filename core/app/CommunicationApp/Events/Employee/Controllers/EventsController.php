<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Events\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Enums\UserTypeEnum;
use App\BaseApp\Models\Branch;
use App\BaseApp\Models\User;
use App\CommunicationApp\Announcements\Employee\Requests\AnnouncementRequest;
use App\CommunicationApp\Announcements\Employee\Transformers\AnnouncementTransformer;
use App\CommunicationApp\Announcements\Employee\Transformers\BranchesFilterTransformer;
use App\CommunicationApp\Announcements\Employee\Transformers\EmployeesUsersFilterTransformer;
use App\CommunicationApp\Announcements\Employee\Transformers\ListAnnouncementsTransformer;
use App\CommunicationApp\Announcements\Employee\Transformers\ViewAnnouncementsTransformer;
use App\CommunicationApp\Events\Employee\Requests\EventRequest;
use App\CommunicationApp\Events\Employee\Transformers\EventTransformer;
use App\CommunicationApp\Events\Repository\EventRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Log;

class EventsController extends BaseApiController
{
    public EventRepositoryInterface  $repository;
    protected string $ModelName = 'Event';
    protected string $ResourceType = ResourceTypesEnums::EVENT;

    /**
     * @param EventRepositoryInterface $repository
     */
    public function __construct(EventRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param EventRequest $request
     * @return array|array[]|JsonResponse
     */
    public function store(EventRequest $request)
    {

        try {
            $data = $request->data['attributes'];
            $data['status'] = 1;
            $data['creator_uuid'] = auth('api')->user()->uuid;
            if ($data['full_day']) {
                $data['end'] = Carbon::createFromFormat('Y-m-d H:i:s', $data['start'])->addDay()->format('Y-m-d 00:00:00');
            }
            if ($data['all_branches']) {
                $data['branches'] = Branch::pluck('uuid')->toArray();
            }
            $createdEvent  = $this->repository->create($data);
            $createdEvent->branches()->attach($data['branches']);
            $createdEvent->loadMissing(['branches', 'translations']);
            return $this->transformDataModInclude($createdEvent, '', new  EventTransformer(), $this->ResourceType, [
                'message' => trans('events.' . $this->ModelName . '  was  created successfully')
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'message' => trans('events.' . $this->ModelName . '  wasn\'t  created '),
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
