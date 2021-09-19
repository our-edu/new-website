<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Questions\Parent\Controllers;

use App\BaseApp\Api\BaseApiController;
use App\BaseApp\Api\Enums\APIActionsEnums;
use App\BaseApp\Enums\ResourceTypesEnums;
use App\CommunicationApp\Questions\Parent\Transformers\ListQuestionsTransformer;
use App\CommunicationApp\Questions\Repository\QuestionRepositoryInterface;
use App\CommunicationApp\Settings\Enums\GeneralSettingsEnum;
use App\CommunicationApp\Settings\Repository\GeneralSettingsRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Log;

class QuestionsController extends BaseApiController
{
    public QuestionRepositoryInterface  $repository;
    public GeneralSettingsRepositoryInterface  $generalSettingsRepository;
    protected string $ModelName = 'Question';
    protected string $ResourceType = ResourceTypesEnums::QUESTION;

    /**
     * @param QuestionRepositoryInterface $repository
     */
    public function __construct(QuestionRepositoryInterface $repository,GeneralSettingsRepositoryInterface $generalSettingsRepository)
    {
        $this->repository = $repository;
        $this->generalSettingsRepository = $generalSettingsRepository;
    }

    /**
     * @return array|array[]|JsonResponse
     */
    public function index()
    {
        $questionnaireStatus = $this->generalSettingsRepository->where('key', GeneralSettingsEnum::getQuestionnaireEnums()['key'])->first();
        if($questionnaireStatus->value == GeneralSettingsEnum::QUESTIONNAIRE_DISABLE) {
            return $this->transformDataModInclude([], '', new  ListQuestionsTransformer(), $this->ResourceType,$this->defaultIncludes());
        }
        $questions = $this->repository->paginate();
        return $this->transformDataModInclude($questions, '', new  ListQuestionsTransformer(), $this->ResourceType,$this->defaultIncludes());
    }

    /**
     * @return array[]
     */
    private function defaultIncludes(): array
    {

        $actions[APIActionsEnums::CREATE_COMPLAIN] = [
            'endpoint_url' => buildScopeRoute('api.parent.complains.store'),
            'label' => trans('complains.'.APIActionsEnums::CREATE_COMPLAIN),
            'method' => 'POST',
            'key' => APIActionsEnums::CREATE_COMPLAIN
        ];
        return ['default_actions' => $actions];

    }


}
