<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Events\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\ExternalAPIs\DashboardAPIEnums;
use App\BaseApp\Models\Branch;
use App\CommunicationApp\Events\Employee\Requests\EventRequest;
use App\CommunicationApp\Events\Employee\Transformers\EventTransformer;
use App\CommunicationApp\Events\Employee\Transformers\ListEventsTransformer;
use App\CommunicationApp\Events\Employee\Transformers\PeriodsFilterTransformer;
use App\CommunicationApp\Events\Repository\EventRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
     * @return array|array[]|JsonResponse
     */
    public function index(Request $request)
    {
        if($request->has('start') && $request->has('start') ){
            $filters = $request->validate([
                'start' => 'date',
                'end' => 'date'
            ]);
            $events = $this->repository->with([
                'branches',
                'creator',
                'translations',
            ])->filterData($filters['start'],$filters['end'])->get();
            return $this->transformDataModInclude($events, '', new  ListEventsTransformer(), $this->ResourceType, $this->includeDefault());
        }
        $events = $this->repository->with([
            'branches',
            'creator',
            'translations',
        ])->get();
        return $this->transformDataModInclude($events, '', new  ListEventsTransformer(), $this->ResourceType, $this->includeDefault());
    }

    public function includeDefault()
    {
        $actions['create_event'] = [
            'endpoint_url' => buildScopeRoute('api.employee.events.store'),
            'label' => trans('events.create-events'),
            'method' => 'POST',
            'key' => APIActionsEnums::CREATE_EVENT
        ];
        $actions['branches_lookups'] = [
            'endpoint_url' => getExternalEndpoint(DashboardAPIEnums::EMPLOYEE_BRANCHES_LOOKUPS),
            'label' => trans('events.branches-lookups'),
            'method' => 'GET',
            'key' => APIActionsEnums::BRANCHES_LOOKUPS
        ];
        $actions['filter'] = [
            'endpoint_url' => buildScopeRoute('api.employee.events.index.filters'),
            'label' => trans('events.filter-event'),
            'method' => 'GET',
            'key' => APIActionsEnums::FILTER_EVENTS
        ];
        return ['default_actions' => $actions];
    }

    /***
     * @return array|array[]|\Illuminate\Http\JsonResponse
     */
    public function indexFilters()
    {
        return response()->json([
            'meta' => filtersObject([
                mapFiltersArrayFromModels(
                    'period',
                    trans('events.periods.period'),
                    'dropdown',
                    [
                        [
                            'key' => 'month',
                            'name' => trans('events.periods.month')
                        ],
                        [
                            'key' => 'week',
                            'name' => trans('events.periods.week')
                        ],
                        [
                            'key' => 'day',
                            'name' => trans('events.periods.day')
                        ],
                    ],
                    new PeriodsFilterTransformer()
                ),
            ])
        ]);
    }

    /**
     * @param $id
     * @return array|array[]|JsonResponse
     */
    public function show($id)
    {
        $event = $this->repository->find($id);
        return $this->transformDataModInclude($event, '', new  EventTransformer(), $this->ResourceType);
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
                $data['branches'] = auth()->user()->schoolEmployee->branches()->pluck('uuid')->toArray();
            }
            $createdEvent  = $this->repository->create($data);
            $createdEvent->branches()->attach($data['branches']);
            $createdEvent->loadMissing(['branches', 'translations']);
            return $this->transformDataModInclude($createdEvent, '', new  EventTransformer(), $this->ResourceType, [
//                'message' => trans('events.' . $this->ModelName . '  was  created successfully')
                'message' => trans('events.was created successfully', ['module_name' => __('events.'.$this->ModelName)]),

            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'message' => trans('events.wasn’t created', ['module_name' => __('events.'.$this->ModelName)]),
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * @param $id
     * @param EventRequest $request
     * @return array|array[]|JsonResponse
     */
    public function update($id, EventRequest $request)
    {
        try {
            $data = $request->data['attributes'];
            if ($data['full_day']) {
                $data['end'] = Carbon::createFromFormat('Y-m-d H:i:s', $data['start'])->addDay()->format('Y-m-d 00:00:00');
            }
            if ($data['all_branches']) {
                $data['branches'] = Branch::pluck('uuid')->toArray();
            }
            $event =  $this->repository->find($id);
            $event->update($data);
            $event->branches()->sync($data['branches']);

            return $this->transformDataModInclude($event, '', new  EventTransformer(), $this->ResourceType, [
                'message' => trans('events.was updated successfully', ['module_name' => __('events.'.$this->ModelName)]),
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'message' => trans('events.wasn’t updated', ['module_name' => __('events.'.$this->ModelName)]),
                'error'=> $exception->getMessage()
            ], 500);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $this->repository->find($id)->delete();
            return response()->json([
                'meta' => [
                    'message' => trans('events.was deleted', ['module_name' => __('events.'.$this->ModelName)]),
                ]
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('events.wasn’t deleted', ['module_name' => __('events.'.$this->ModelName)]),
                    'error'=> $exception->getMessage()
                ]
            ], 500);
        }
    }
}
