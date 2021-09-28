<?php

declare(strict_types = 1);

namespace App\CommunicationApp\CommunicationsLogs\Visits\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\BaseApp\Enums\UserTypeEnum;
use App\BaseApp\Models\User;
use App\CommunicationApp\CommunicationsLogs\Enums\CommunicationLogTypesEnums;
use App\CommunicationApp\CommunicationsLogs\Repository\CommunicationLogRepositoryInterface;
use App\CommunicationApp\CommunicationsLogs\Visits\Employee\Requests\VisitRequest;
use App\CommunicationApp\CommunicationsLogs\Visits\Employee\Transformers\ListVisitsTransformer;
use App\CommunicationApp\CommunicationsLogs\Visits\Employee\Transformers\VisitTransformer;
use Exception;
use Illuminate\Http\JsonResponse;
use Log;

class VisitsController extends BaseApiController
{
    public CommunicationLogRepositoryInterface  $repository;
    protected string $ModelName = 'Visit';
    protected string $ResourceType = ResourceTypesEnums::VISITS;

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
        $visits = $this->repository->where('type', CommunicationLogTypesEnums::VISITS)->where('branch_uuid', $currentEmployeeBranch)->paginate();
        return $this->transformDataModInclude($visits, '', new  ListVisitsTransformer(), $this->ResourceType);
    }

    /**
     * @param $id
     * @return array|array[]|JsonResponse
     */
    public function show($id)
    {
        $visit = $this->repository->find($id);
        return $this->transformDataModInclude($visit, '', new  VisitTransformer(), $this->ResourceType);
    }

    /**
     * @param VisitRequest $request
     * @return array|array[]|JsonResponse
     */
    public function store(VisitRequest  $request)
    {

        try {
            $data = $request->data['attributes'];
            $parent_national_id  = $data['parent_national_id'];
            $parentUser = User::where('national_id',$parent_national_id)->where('type',UserTypeEnum::PARENT)->first();
            if(!$parentUser){
                $returnArr['status'] = 422;
                $returnArr['detail'] = __('visits.parent national id is invalid  ');
                $returnArr['title'] = 'invalid parent';
                return response()->json(["errors" => [$returnArr] ], 422);
            }
            $data['parent_uuid'] = $parentUser->parent->uuid;
            $data['type'] = CommunicationLogTypesEnums::VISITS;
            $data['branch_uuid']  = auth('api')->user()->schoolEmployee->branch_id;
            $createdVisit  = $this->repository->create($data);
            return $this->transformDataModInclude($createdVisit, '', new  VisitTransformer(), $this->ResourceType, [
                'meta' => [
                    'message' => trans('visits.' . $this->ModelName . '  was  created successfully')
                ]
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('visits.' . $this->ModelName . '  wasn\'t  created '),
                    'error'=> $exception->getMessage()
                ]
            ], 500);
        }
    }

    /**
     * @param $id
     * @param VisitRequest $request
     * @return array|array[]|JsonResponse
     */
    public function update($id, VisitRequest $request)
    {
        try {
            $data = $request->data['attributes'];
            $parent_national_id  = $data['parent_national_id'];
            $parentUser = User::where('national_id',$parent_national_id)->where('type',UserTypeEnum::PARENT)->first();
            if(!$parentUser){
                $returnArr['status'] = 422;
                $returnArr['detail'] = __('visits.parent national id is invalid  ');
                $returnArr['title'] = 'invalid parent';
                return response()->json(["errors" => [$returnArr] ], 422);
            }
            $data['parent_uuid'] = $parentUser->parent->uuid;
            $visit =  $this->repository->find($id);
            $visit->update($data);

            return $this->transformDataModInclude($visit, '', new  VisitTransformer(), $this->ResourceType, [
                'meta' => [
                    'message' => trans('visits.' . $this->ModelName . '  was  updated successfully')
                ]
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('visits.' . $this->ModelName . '  wasn\'t  updated '),
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
                    'message' => trans('visits.' . $this->ModelName . '  was deleted '),
                ]
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('visits.' . $this->ModelName . '  wasn\'t  deleted '),
                    'error'=> $exception->getMessage()
                ]
            ], 500);
        }
    }
}
