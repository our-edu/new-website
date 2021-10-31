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
     * @return array|array[]|JsonResponse
     */
    public function updateQuestionnaireStatus($id, QuestionnaireRequest $request)
    {
        try {
            $questionnaire =  $this->repository->find($id);
            $questionnaire->update([
                'value' => $request->data['attributes']['value']
            ]);
            return $this->transformDataModInclude($questionnaire, '', new  SettingsTransformer(), $this->ResourceType, [
                'message' => trans('generalSettings.was updated successfully', ['module_name' => __('generalSettings.'.$this->ModelName)]),
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('generalSettings.wasn’t updated', ['module_name' => __('generalSettings.'.$this->ModelName)]),
                    'error'=> $exception->getMessage()
                ]
            ], 500);
        }
    }
}
