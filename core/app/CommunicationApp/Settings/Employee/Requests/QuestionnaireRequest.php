<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Settings\Employee\Requests;

use App\BaseApp\Api\Requests\BaseApiRequest;
use App\CommunicationApp\Settings\Enums\GeneralSettingsEnum;

class QuestionnaireRequest extends BaseApiRequest
{
    public function rules()
    {
        $enable =  GeneralSettingsEnum::getQuestionnaireEnums()['value']['enable'];
        $disable =  GeneralSettingsEnum::getQuestionnaireEnums()['value']['disable'];
        $statusValueMapped = implode(',', [$enable,$disable]);
        return [
            'value' => 'required|bool|in:'.$statusValueMapped
        ];
    }

    public function attributes()
    {
        return [
            'value' => trans('generalSettings.fields.value'),

        ];
    }
}
