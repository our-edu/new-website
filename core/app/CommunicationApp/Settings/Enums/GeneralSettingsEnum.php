<?php

namespace App\CommunicationApp\Settings\Enums;

Abstract class GeneralSettingsEnum
{
    public const QUESTIONNAIRE_STATUS_KEY = "questionnaire_status";
    public const QUESTIONNAIRE_ENABLE = "true";
    public const QUESTIONNAIRE_DISABLE = "false";

    /**
     * @return string[][]
     */
    public static function getQuestionnaireEnums(): array
    {
        return [
                'key' => self::QUESTIONNAIRE_STATUS_KEY,
                'type' => 'boolean',
                'value'=>[
                        'enable' => self::QUESTIONNAIRE_ENABLE,
                        'disable' => self::QUESTIONNAIRE_DISABLE
                ]
            ];
    }

}