<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Enums;

abstract class ComplainStatusesEnum
{
    const OPENED_EN = 'opened';
    const OPENED_AR = 'مفتوح';
    const RESOLVED_EN = 'resolved';
    const RESOLVED_AR = 'تم الحل';

    public static function getStatuses()
    {
        return [
            self::OPENED_EN =>
                [
                    'en' => self::OPENED_EN,
                    'ar' => self::OPENED_AR
                ],
            self::RESOLVED_EN => [
                'en' => self::RESOLVED_EN,
                'ar' => self::RESOLVED_AR

            ]
        ];
    }
}
