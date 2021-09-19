<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Parent\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\CommunicationApp\Complains\Enums\ComplainStatusesEnum;
use App\CommunicationApp\Complains\Parent\Requests\ComplainRequest;
use App\CommunicationApp\Complains\Parent\Transformers\ComplainTransformer;
use App\CommunicationApp\Complains\Parent\Transformers\ListComplainsTransformer;
use App\CommunicationApp\Complains\Repository\ComplainRepositoryInterface;
use App\CommunicationApp\Settings\Enums\GeneralSettingsEnum;
use App\CommunicationApp\Settings\model\GeneralSettings;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
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
            $data['status'] =  ComplainStatusesEnum::OPENED_EN;
            $data['parent_uuid'] = auth('api')->user()->parent->uuid;
            $questionnaireStatus = GeneralSettings::where('key',GeneralSettingsEnum::QUESTIONNAIRE_STATUS_KEY)->first()->value;
            DB::beginTransaction();
            $createdComplain  = $this->repository->create($data);
            if(isset($data['questions_answers']) && $questionnaireStatus != GeneralSettingsEnum::QUESTIONNAIRE_DISABLE){
                $answers = $data['questions_answers'];
                $this->repository->addQuestionnaireAnswers($createdComplain,$answers);
            }
            DB::commit();
            return $this->transformDataModInclude($createdComplain, '', new  ComplainTransformer(), $this->ResourceType, [
                'meta' => [
                    'message' => trans('complains.' . $this->ModelName . '  was  created successfully')
                ]
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
            return response()->json([
                'meta' => [
                    'message' => trans('complains.' . $this->ModelName . '  wasn\'t  created '),
                    'error'=> $exception->getMessage()
                ]
            ], 400);
        }
    }
}
