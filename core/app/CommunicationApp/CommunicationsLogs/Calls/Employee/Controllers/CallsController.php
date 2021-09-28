<?php

declare(strict_types = 1);

namespace App\CommunicationApp\CommunicationsLogs\Calls\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\CommunicationApp\CommunicationsLogs\Calls\Employee\Requests\CallRequest;
use App\CommunicationApp\CommunicationsLogs\Calls\Employee\Transformers\CallTransformer;
use App\CommunicationApp\CommunicationsLogs\Calls\Employee\Transformers\ListCallsTransformer;
use App\CommunicationApp\CommunicationsLogs\Enums\CommunicationLogTypesEnums;
use App\CommunicationApp\CommunicationsLogs\Repository\CommunicationLogRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Log;

class CallsController extends BaseApiController
{
    public CommunicationLogRepositoryInterface  $repository;
    protected string $ModelName = 'Call';
    protected string $ResourceType = ResourceTypesEnums::CALLS;

    /**
     * @param CommunicationLogRepositoryInterface $repository
     */
    public function __construct(CommunicationLogRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array|array[]|JsonResponse
     */
    public function index()
    {
        $currentEmployeeBranch = auth('api')->user()->schoolEmployee->branch_id;
        $calls = $this->repository->where('type', CommunicationLogTypesEnums::CALLS)->where('branch_uuid', $currentEmployeeBranch)->paginate();
        return $this->transformDataModInclude($calls, '', new  ListCallsTransformer(), $this->ResourceType);
    }

    /**
     * @param $id
     * @return array|array[]|JsonResponse
     */
    public function show($id)
    {
        $call = $this->repository->find($id);
        return $this->transformDataModInclude($call, '', new  CallTransformer(), $this->ResourceType);
    }

    /**
     * @param CallRequest $request
     * @return array|array[]|JsonResponse
     */
    public function store(CallRequest  $request)
    {

        try {
            $data = $request->data['attributes'];
            $data['type'] = CommunicationLogTypesEnums::CALLS;
            $data['branch_uuid']  = auth('api')->user()->schoolEmployee->branch_id;
            $createdCall  = $this->repository->create($data);
            return $this->transformDataModInclude($createdCall, '', new  CallTransformer(), $this->ResourceType, [
                'meta' => [
                    'message' => trans('calls.' . $this->ModelName . '  was  created successfully')
                ]
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('calls.' . $this->ModelName . '  wasn\'t  created '),
                    'error'=> $exception->getMessage()
                ]
            ], 500);
        }
    }

    /**
     * @param $id
     * @param CallRequest $request
     * @return array|array[]|JsonResponse
     */
    public function update($id, CallRequest $request)
    {
        try {
            $data = $request->data['attributes'];
            $call=  $this->repository->find($id);
            $call->update($data);

            return $this->transformDataModInclude($call, '', new  CallTransformer(), $this->ResourceType, [
                'meta' => [
                    'message' => trans('calls.' . $this->ModelName . '  was  updated successfully')
                ]
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('calls.' . $this->ModelName . '  wasn\'t  updated '),
                    'error'=> $exception->getMessage()
                ]
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
                    'message' => trans('calls.' . $this->ModelName . '  was deleted '),
                ]
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('calls.' . $this->ModelName . '  wasn\'t  deleted '),
                    'error'=> $exception->getMessage()
                ]
            ], 500);
        }
    }
}