<?php

declare(strict_types = 1);

namespace App\RegistrationApp\Users\Repository;

use App\BaseApp\Models\User;
use App\BaseApp\Repository\Repository;

class UserRepository extends Repository implements UserRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }
}
