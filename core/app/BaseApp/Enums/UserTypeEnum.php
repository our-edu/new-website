<?php

declare(strict_types = 1);

namespace App\BaseApp\Enums;

abstract class UserTypeEnum
{
    const PARENT = "parent";
    const EMPLOYEE = "employee";
    const ADMIN = "admin";
    const STUDENT = "student";
}
