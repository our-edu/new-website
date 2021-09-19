<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Parent\Requests;

use App\BaseApp\Api\Requests\BaseApiRequest;
use App\CommunicationApp\Settings\Enums\GeneralSettingsEnum;
use App\CommunicationApp\Settings\model\GeneralSettings;

class ComplainRequest extends BaseApiRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {

        $questionnaireStatus = GeneralSettings::where('key', GeneralSettingsEnum::getQuestionnaireEnums()['key'])->first();
        if($questionnaireStatus->value == GeneralSettingsEnum::QUESTIONNAIRE_DISABLE) {
            $questionAnswerValidation = 'array';
        }else{
            $questionAnswerValidation  = 'required|array';
        }
        return [
            'student_uuid'      => 'required|exists:students,uuid',
            'body'              => 'required',
            'title'             => 'required|string|min:10',
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
            'student_uuid' => trans('complains.fields.student_uuid')
        ];
    }
}
