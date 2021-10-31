<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Complains\Enums;

abstract class ComplainCategoriesEnum
{
    const CANTEEN_EN = 'canteen';
    const CANTEEN_AR = 'المقصف';
    const ACCOUNTS_EN = 'accounts';
    const ACCOUNTS_AR = 'الحسابات';
    const FINANCE_EN = 'finance';
    const FINANCE_AR = 'الماليه';
    const REGISTRATION_EN = 'registration';
    const REGISTRATION_AR = 'التسجيل والقبول';
    const OTHER_EN = 'other';
    const OTHER_AR= 'أخري';


    public static function getCategoriesTranslated(): array
    {
        return [
            self::CANTEEN_EN =>
                [
                    'en' => self::CANTEEN_EN,
                    'ar' => self::CANTEEN_AR
                ],
            self::ACCOUNTS_EN => [
                'en' => self::ACCOUNTS_EN,
                'ar' => self::ACCOUNTS_AR
            ],
            self::FINANCE_EN => [
                'en' => self::FINANCE_EN,
                'ar' => self::FINANCE_AR
            ],
            self::REGISTRATION_EN => [
                'en' => self::REGISTRATION_EN,
                'ar' => self::REGISTRATION_AR
            ] ,
            self::OTHER_EN => [
                'en' => self::OTHER_EN,
                'ar' => self::OTHER_AR
            ]
        ];
    }
    public static function getCategories(): array
    {
        return array_keys(self::getCategoriesTranslated());
    }
}
