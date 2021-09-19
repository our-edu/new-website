<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Settings\Enums;

abstract class GeneralSettingsEnum
{
    public const QUESTIONNAIRE_STATUS_KEY = "questionnaire_status";
    public const QUESTIONNAIRE_ENABLE = true;
    public const QUESTIONNAIRE_DISABLE = false;


    /**
     * @return array
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
