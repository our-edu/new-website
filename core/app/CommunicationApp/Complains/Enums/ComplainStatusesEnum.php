<?php
namespace App\CommunicationApp\Complains\Enums;

abstract class ComplainStatusesEnum
{
    const OPENED_EN = 'opened';
    const OPENED_AR = 'مفتوح';
    const RESOLVED_EN = 'resolved';
    const RESOLVED_AR = 'تم الحل';

    public  static function getStatuses()
    {
        return [
            self::OPENED_EN =>
                [
                    'english' => self::OPENED_EN,
                    'arabic' => self::OPENED_AR
                ],
            self::RESOLVED_EN => [
                'english' => self::RESOLVED_EN,
                'arabic' => self::RESOLVED_AR

            ]
        ];
    }

}