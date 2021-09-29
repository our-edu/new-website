<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Questions\Employee\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\CommunicationApp\Questions\Employee\Requests\QuestionRequest;
use App\CommunicationApp\Questions\Employee\Transformers\ListQuestionsTransformer;
use App\CommunicationApp\Questions\Employee\Transformers\QuestionTransformer;
use App\CommunicationApp\Questions\Repository\QuestionRepositoryInterface;
use App\CommunicationApp\Questions\UseCases\DeleteUseCases\DeleteQuestionUseCaseInterface;
use App\CommunicationApp\Settings\Enums\GeneralSettingsEnum;
use App\CommunicationApp\Settings\model\GeneralSettings;
use App\CommunicationApp\Settings\Repository\GeneralSettingsRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Log;

class QuestionsController extends BaseApiController
{
    public QuestionRepositoryInterface  $repository;
    public GeneralSettingsRepositoryInterface  $generalSettingsRepository;
    public DeleteQuestionUseCaseInterface  $deleteQuestionUseCase;
    protected string $ModelName = 'Question';
    protected string $ResourceType = ResourceTypesEnums::QUESTION;

    /**
     * @param QuestionRepositoryInterface $repository
     */
    public function __construct(QuestionRepositoryInterface $repository, GeneralSettingsRepositoryInterface $generalSettingsRepository, DeleteQuestionUseCaseInterface $deleteQuestionUseCase)
    {
        $this->repository = $repository;
        $this->generalSettingsRepository = $generalSettingsRepository;
        $this->deleteQuestionUseCase = $deleteQuestionUseCase;
    }

    /**
     * @return array|array[]|JsonResponse
     */
    public function index()
    {
        $questions = $this->repository->paginate();
        $questionnaireStatus = $this->generalSettingsRepository->where('key', GeneralSettingsEnum::getQuestionnaireEnums()['key'])->first();
        return $this->transformDataModInclude($questions, '', new  ListQuestionsTransformer(), $this->ResourceType, array_merge(['questionnaireStatus'=>$questionnaireStatus->value], $this->defaultIncludes($questionnaireStatus)));
    }

    /**
     * @param $id
     * @return array|array[]|JsonResponse
     */
    public function show($id)
    {
        $question = $this->repository->find($id);
        return $this->transformDataModInclude($question, '', new  QuestionTransformer(), $this->ResourceType);
    }

    /**
     * @param QuestionRequest $request
     * @return array|array[]|JsonResponse
     */
    public function store(QuestionRequest $request)
    {

        try {
            $data = $request->data['attributes'];
            $createdQuestion  = $this->repository->create($data);

            return $this->transformDataModInclude($createdQuestion, '', new  QuestionTransformer(), $this->ResourceType, [
                    'message' => trans('questions.' . $this->ModelName . '  was  created successfully')

            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('questions.' . $this->ModelName . '  wasn\'t  created '),
                    'error'=> $exception->getMessage()
                ]
            ], 500);
        }
    }

    /**
     * @param $id
     * @param QuestionRequest $request
     * @return array|array[]|JsonResponse
     */
    public function update($id, QuestionRequest $request)
    {
        try {
            $data = $request->data['attributes'];
            $question =  $this->repository->find($id);
            $question->update($data);

            return $this->transformDataModInclude($question, '', new  QuestionTransformer(), $this->ResourceType, [
                    'message' => trans('questions.' . $this->ModelName . '  was  updated successfully')

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

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $question = $this->repository->find($id);
            $errors = $this->deleteQuestionUseCase->checkAnswers($question);
            if (!empty($errors)) {
                return formatErrorValidation($errors);
            }
            $question->delete();
            return response()->json([
                'meta' => [
                    'message' => trans('questions.' . $this->ModelName . '  was deleted '),
                ]
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'meta' => [
                    'message' => trans('questions.' . $this->ModelName . '  wasn\'t  deleted '),
                    'error'=> $exception->getMessage()
                ]
            ], 500);
        }
    }
    private function defaultIncludes($model): array
    {
        $actions[APIActionsEnums::UPDATE_QUESTIONNAIRE_STATUS] = [
            'endpoint_url' => buildScopeRoute('api.employee.generalSettings.updateQuestionnaire', [
                'generalSetting' => $model->uuid,
            ]),
            'label' => trans('questions.'.APIActionsEnums::UPDATE_QUESTIONNAIRE_STATUS),
            'method' => 'PUT',
            'key' => APIActionsEnums::UPDATE_QUESTIONNAIRE_STATUS
        ];
        return ['default_actions' => $actions];
    }
}
