<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Employee\Transformers;

use App\BaseApp\Models\User;

class EmployeesUsersFilterTransformer
{
    public $filter_key = 'uuid';

    public function value(User $user): array
    {
        return [
            'name' =>  (string) $user->name
        ];
    }

    public function valueKeys(): array
    {
        return [
            'name'
        ];
    }
}
