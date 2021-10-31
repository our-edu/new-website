<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Parent\Requests;

use App\BaseApp\Api\Requests\BaseApiRequest;
use App\CommunicationApp\Complains\Enums\ComplainCategoriesEnum;
use App\CommunicationApp\Settings\Enums\GeneralSettingsEnum;
use App\CommunicationApp\Settings\model\GeneralSettings;
use Illuminate\Validation\Rule;

class ComplainRequest extends BaseApiRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {

        $questionnaireStatus = GeneralSettings::where('key', GeneralSettingsEnum::getQuestionnaireEnums()['key'])->first();
        if ($questionnaireStatus->value == GeneralSettingsEnum::QUESTIONNAIRE_DISABLE) {
            $questionAnswerValidation = 'array';
        } else {
            $questionAnswerValidation  = 'required|array';
        }
        return [
            'student_uuid'      => 'required|exists:students,uuid',
            'body'              => 'required',
            'title'             => 'required|string|min:10',
            'category' =>'required|'.Rule::in(ComplainCategoriesEnum::getCategories()),
            'questions_answers' => $questionAnswerValidation,
            'questions_answers.*.question_uuid' => 'required_with:questions_answers|exists:questions,uuid',
            'questions_answers.*.answer' => 'required_with:questions_answers',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'body' => trans('complains.fields.body'),
            'title' => trans('complains.fields.title'),
            'parent_uuid' => trans('complains.fields.parent_uuid'),
            'student_uuid' => trans('complains.fields.student_uuid'),
            'category' => trans('complains.fields.category'),
            'questions_answers' => trans('complains.fields.questions_answers'),
            'questions_answers.*.question_uuid' => trans('complains.fields.questions_answers.question_uuid'),
            'questions_answers.*.answer' => trans('complains.fields.questions_answers.answer'),
        ];
    }
}
