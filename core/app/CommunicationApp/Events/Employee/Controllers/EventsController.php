<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Events\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Models\Branch;
use App\CommunicationApp\Events\Employee\Requests\EventRequest;
use App\CommunicationApp\Events\Employee\Transformers\EventTransformer;
use App\CommunicationApp\Events\Employee\Transformers\ListEventsTransformer;
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
     * @return array|array[]|JsonResponse
     */
    public function index()
    {
        $events = $this->repository->with([
            'branches',
            'creator',
            'translations',
        ])->filterData()->paginate();
        return $this->transformDataModInclude($events, '', new  ListEventsTransformer(), $this->ResourceType);
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
                'message' => trans('events.' . $this->ModelName . '  was  updated successfully')
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'message' => trans('events.' . $this->ModelName . '  wasn\'t  updated '),
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
                    'message' => trans('events.' . $this->ModelName . '  was deleted '),
                ]
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('events.' . $this->ModelName . '  wasn\'t  deleted '),
                    'error'=> $exception->getMessage()
                ]
            ], 500);
        }
    }
}
