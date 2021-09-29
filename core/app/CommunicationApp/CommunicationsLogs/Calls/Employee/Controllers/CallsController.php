<?php

declare(strict_types = 1);

namespace App\CommunicationApp\CommunicationsLogs\Calls\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Enums\UserTypeEnum;
use App\BaseApp\ExternalAPIs\DashboardAPIEnums;
use App\BaseApp\Models\User;
use App\CommunicationApp\CommunicationsLogs\Calls\Employee\Requests\CallRequest;
use App\CommunicationApp\CommunicationsLogs\Calls\Employee\Transformers\CallTransformer;
use App\CommunicationApp\CommunicationsLogs\Calls\Employee\Transformers\ListCallsTransformer;
use App\CommunicationApp\CommunicationsLogs\Enums\CommunicationLogTypesEnums;
use App\CommunicationApp\CommunicationsLogs\Repository\CommunicationLogRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        $currentEmployeeBranch = auth('api')->user()->schoolEmployee->branch_id;
        if ($request->has('parent_uuid')) {
            $calls = $this->repository->where('type', CommunicationLogTypesEnums::CALLS)->where('branch_uuid', $currentEmployeeBranch)->where('parent_uuid', $request->parent_uuid)->paginate();
            return $this->transformDataModInclude($calls, '', new  ListCallsTransformer(), $this->ResourceType);
        }
            $calls = $this->repository->where('type', CommunicationLogTypesEnums::CALLS)->where('branch_uuid', $currentEmployeeBranch)->paginate();
        return $this->transformDataModInclude($calls, '', new  ListCallsTransformer(), $this->ResourceType);

    }

    public function includeDefault()
    {
        $actions['export'] = [
            'endpoint_url' => buildScopeRoute('api.employee.calls.index.export'),
            'label' => trans('app.export-calls'),
            'method' => 'GET',
            'key' => APIActionsEnums::EXPORT_CALLS
        ];
        return ['default_actions' => $actions];
    }

    /**
     * @return array|array[]|JsonResponse
     */
    public function export()
    {
        $currentEmployeeBranch = auth('api')->user()->schoolEmployee->branch_id;
        return $this->repository->export(CommunicationLogTypesEnums::CALLS, $currentEmployeeBranch);
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
            $parent_national_id  = $data['parent_national_id'];
            $parentUser = User::where('national_id', $parent_national_id)->where('type', UserTypeEnum::PARENT)->first();
            if (!$parentUser) {
                $returnArr['status'] = 422;
                $returnArr['detail'] = __('calls.parent national id is invalid  ');
                $returnArr['title'] = 'invalid parent';
                return response()->json(["errors" => [$returnArr] ], 422);
            }
            $data['parent_uuid'] = $parentUser->parent->uuid;
            $data['type'] = CommunicationLogTypesEnums::CALLS;
            $data['branch_uuid']  = auth('api')->user()->schoolEmployee->branch_id;
            $data['creator_uuid']  = auth('api')->user()->uuid;
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
            $parent_national_id  = $data['parent_national_id'];
            $parentUser = User::where('national_id', $parent_national_id)->where('type', UserTypeEnum::PARENT)->first();
            if (!$parentUser) {
                $returnArr['status'] = 422;
                $returnArr['detail'] = __('calls.parent national id is invalid  ');
                $returnArr['title'] = 'invalid parent';
                return response()->json(["errors" => [$returnArr] ], 422);
            }
            $data['parent_uuid'] = $parentUser->parent->uuid;
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
