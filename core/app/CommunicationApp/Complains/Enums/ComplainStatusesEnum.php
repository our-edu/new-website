<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Enums;

abstract class ComplainStatusesEnum
{
    const OPENED_EN = 'opened';
    const OPENED_AR = 'مفتوح';
    const RESOLVED_EN = 'resolved';
    const RESOLVED_AR = 'تم الحل';
    const CONFIRMED_EN = 'confirmed';
    const CONFIRMED_AR = 'تم التاكيد';
    const REJECTED_EN = 'rejected';
    const REJECTED_AR = 'تم الرفض';

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

            ],
            self::CONFIRMED_EN => [
                'en' => self::CONFIRMED_EN,
                'ar' => self::CONFIRMED_AR

            ],
            self::REJECTED_EN => [
                'en' => self::REJECTED_EN,
                'ar' => self::REJECTED_AR

            ],
        ];
    }
}
