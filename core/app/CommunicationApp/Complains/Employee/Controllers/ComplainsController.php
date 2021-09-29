<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\CommunicationApp\Complains\Employee\Requests\ResolveComplainRequest;
use App\CommunicationApp\Complains\Employee\Transformers\ComplainTransformer;
use App\CommunicationApp\Complains\Employee\Transformers\ListComplainsTransformer;
use App\CommunicationApp\Complains\Enums\ComplainStatusesEnum;
use App\CommunicationApp\Complains\Repository\ComplainRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        if ($request->has('parent_uuid')) {
            $complains = $this->repository->with('questionsAnswers')->where('parent_uuid', $request->parent_uuid)->paginate();
            return $this->transformDataModInclude($complains, '', new  ListComplainsTransformer(), $this->ResourceType);
        }
        $complains = $this->repository->with('questionsAnswers')->paginate();
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
     * @param $id
     * @param ResolveComplainRequest $request
     * @return array|array[]|JsonResponse
     */
    public function resolve($id, ResolveComplainRequest $request)
    {
        try {
            $data = $request->data['attributes'];
            $complain = $this->repository->find($id);
            $employee = auth('api')->user()->uuid;
            $complain->update($data);
            $complain->statuses()->create([
                'name' => ComplainStatusesEnum::RESOLVED_EN,
                'user_uuid' => $employee
            ]);
            return $this->transformDataModInclude($complain, '', new  ComplainTransformer(), $this->ResourceType, [
                'meta' => [
                    'message' => trans('complains.' . $this->ModelName . '  was  resolved successfully')
                ]
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'meta' => [
                    'message' => trans('complains.' . $this->ModelName . '  wasn\'t  resolved '),
                    'error'=> $exception->getMessage()
                ]
            ], 500);
        }
    }
}
