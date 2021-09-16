<?php

namespace App\CommunicationApp\Settings\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\CommunicationApp\Settings\Enums\GeneralSettingsEnum;
use App\CommunicationApp\Settings\Repository\GeneralSettingsRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Log;
use PHPUnit\Exception;
use Request;

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
     *
     */
    public function index()
    {

    }

    /**
     * @param $id
     */
    public function show($id)
    {

    }

    /**
     * @param $id
     * @param Request $request
     */
    public function update($id , Request $request)
    {

    }

    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function toggleQuestionnaireStatus($id, Request $request): JsonResponse
    {
        try{
            $enable =  GeneralSettingsEnum::getQuestionnaireEnums()['value']['enable'];
            $disable =  GeneralSettingsEnum::getQuestionnaireEnums()['value']['disable'];
            $statusValueMapped = implode(',',[$enable,$disable]);
            $request->validate([
               'value' => 'bool|in:'.$statusValueMapped
            ]);
            $questionnaire =  $this->repository->where('key',GeneralSettingsEnum::getQuestionnaireEnums()['key'])->first();
            $questionnaire->update([
                'value' => $request->data['attributes']['value']
            ]);
            return response()->json([
                'meta' => [
                    'message' => trans('questions.' . $this->ModelName . '  was   updated  successfully'),
                ]
            ]);
        }catch (Exception $exception){
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('questions.' . $this->ModelName . '  wasn\'t  updated '),
                    'error'=> $exception->getMessage()
                ]
            ], 400);
        }
    }
}