<?php

namespace App\CommunicationApp\Settings\Enums;

Abstract class GeneralSettingsEnum
{
    public const QUESTIONNAIRE_STATUS_KEY = "enable_questionnaire";
    public const QUESTIONNAIRE_ENABLE = "true";
    public const QUESTIONNAIRE_DISABLE = "false";

    /**
     * @return string[][]
     */
    public static function getQuestionnaireEnums(): array
    {
        return [
            self::QUESTIONNAIRE_STATUS_KEY => [
                'enable' => self::QUESTIONNAIRE_ENABLE,
                'disable' => self::QUESTIONNAIRE_DISABLE
            ]
        ];
    }

}