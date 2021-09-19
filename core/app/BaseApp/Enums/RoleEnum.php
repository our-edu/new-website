<?php

declare(strict_types = 1);

namespace App\BaseApp\Enums;

class RoleEnum
{
    const LEADER = "leader";
    const LEADER_EN = "Leader";
    const LEADER_AR = "قائد";
    const SUPERVISOR = "supervisor";
    const SUPERVISOR_EN = "Supervisor";
    const SUPERVISOR_AR = "وكيل";
    const ACADEMIC_COORDINATOR = "academicCoordinator";
    const ACADEMIC_COORDINATOR_EN = "Academic Coordinator";
    const ACADEMIC_COORDINATOR_AR = "منسق أكاديمي";
    
    public static function getRoles()
    {
        return [
            self::LEADER => [
                'display_ar' => self::LEADER_AR,
                'display_en' => self::LEADER_EN,
            ],
            self::SUPERVISOR => [
                'display_ar' => self::SUPERVISOR_AR,
                'display_en' => self::SUPERVISOR_EN,
            ],
            self::ACADEMIC_COORDINATOR => [
                'display_ar' => self::ACADEMIC_COORDINATOR_AR,
                'display_en' => self::ACADEMIC_COORDINATOR_EN,
            ]
        ];
    }
    
    public static function getRoleName()
    {
        return [self::LEADER, self::SUPERVISOR, self::ACADEMIC_COORDINATOR];
    }
}
