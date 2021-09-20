<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\CommunicationApp\Complains\Employee\Requests\ComplainRequest;
use App\CommunicationApp\Complains\Employee\Transformers\ComplainTransformer;
use App\CommunicationApp\Complains\Employee\Transformers\ListComplainsTransformer;
use App\CommunicationApp\Complains\Repository\ComplainRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Log;

class ComplainsController extends BaseApiController
{
    public ComplainRepositoryInterface  $repository;
    protected string $ModelName = 'Complain';
    protected string $ResourceType = ResourceTypesEnums::COMPLAIN;

    /**
     * @param ComplainRepositoryInterface $repository
     */
    public function __construct(ComplainRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array|array[]|JsonResponse
     */
    public function index()
    {
        $complains = $this->repository->paginate();
        return $this->transformDataModInclude($complains, '', new  ListComplainsTransformer(), $this->ResourceType);
    }

    /**
     * @param $id
     * @return array|array[]|JsonResponse
     */
    public function show($id)
    {
        $complain = $this->repository->find($id);
        return $this->transformDataModInclude($complain, '', new  ComplainTransformer(), $this->ResourceType);
    }

    /**
     * @param ComplainRequest $request
     * @return array|array[]|JsonResponse
     */
    public function store(ComplainRequest  $request)
    {

        try {
            $data = $request->data['attributes'];
            $createdComplain  = $this->repository->create($data);

            return $this->transformDataModInclude($createdComplain, '', new  ComplainTransformer(), $this->ResourceType, [
                'meta' => [
                    'message' => trans('complains.' . $this->ModelName . '  was  created successfully')
                ]
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('complains.' . $this->ModelName . '  wasn\'t  created '),
                    'error'=> $exception->getMessage()
                ]
            ], 500);
        }
    }

    /**
     * @param $id
     * @param ComplainRequest $request
     * @return array|array[]|JsonResponse
     */
    public function update($id, ComplainRequest $request)
    {
        try {
            $data = $request->data['attributes'];
            $complain =  $this->repository->find($id);
            $complain->update($data);

            return $this->transformDataModInclude($complain, '', new  ComplainTransformer(), $this->ResourceType, [
                'meta' => [
                    'message' => trans('complains.' . $this->ModelName . '  was  updated successfully')
                ]
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('complains.' . $this->ModelName . '  wasn\'t  updated '),
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
                    'message' => trans('complains.' . $this->ModelName . '  was deleted '),
                ]
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('complains.' . $this->ModelName . '  wasn\'t  deleted '),
                    'error'=> $exception->getMessage()
                ]
            ], 500);
        }
    }
}
