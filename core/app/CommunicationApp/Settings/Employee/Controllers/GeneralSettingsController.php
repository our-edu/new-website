<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Settings\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\CommunicationApp\Settings\Employee\Requests\QuestionnaireRequest;
use App\CommunicationApp\Settings\Employee\Transformers\ListSettingsTransformer;
use App\CommunicationApp\Settings\Employee\Transformers\SettingsTransformer;
use App\CommunicationApp\Settings\Enums\GeneralSettingsEnum;
use App\CommunicationApp\Settings\model\GeneralSettings;
use App\CommunicationApp\Settings\Repository\GeneralSettingsRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;
use PHPUnit\Exception;

class GeneralSettingsController extends BaseApiController
{
    public GeneralSettingsRepositoryInterface  $repository;
    protected string $ModelName = 'GeneralSettings';
    protected string $ResourceType = ResourceTypesEnums::GENERAL_SETTING;

    public function __construct(GeneralSettingsRepositoryInterface $generalSettingsRepository)
    {
        $this->repository = $generalSettingsRepository;
    }

    /**
     * @return array|array[]|JsonResponse
     */
    public function index()
    {
        $generalSettings = $this->repository->paginate();
        return $this->transformDataModInclude($generalSettings, '', new  ListSettingsTransformer(), $this->ResourceType);
    }

    /**
     * @param $id
     * @return array|array[]|JsonResponse
     */
    public function show($id)
    {
        $generalSettings = $this->repository->find($id);
        return $this->transformDataModInclude($generalSettings, '', new  SettingsTransformer(), $this->ResourceType);
    }

    /**
     * @param $id
     * @param Request $request
     */
    public function update($id, Request $request)
    {
        //TODO Implement the update
    }

    /**
     * @param $id
     * @param QuestionnaireRequest $request
     * @return JsonResponse
     */
    public function updateQuestionnaireStatus($id, QuestionnaireRequest $request): JsonResponse
    {
        try {
            $questionnaire =  $this->repository->find($id);
            $questionnaire->update([
                'value' => $request->data['attributes']['value']
            ]);
            return response()->json([
                'meta' => [
                    'message' => trans('questions.' . $this->ModelName . '  was   updated  successfully'),
                ]
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('questions.' . $this->ModelName . '  wasn\'t  updated '),
                    'error'=> $exception->getMessage()
                ]
            ], 500);
        }
    }
}
