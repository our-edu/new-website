<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Announcements\Employee\Transformers;

use App\BaseApp\Models\Branch;

class BranchesFilterTransformer
{
    public $filter_key = 'uuid';

    public function value(Branch $branch): array
    {
        return [
            'name' =>  (string) $branch->name
        ];
    }

    public function value_keys(): array
    {
        return [
            'name'
        ];
    }
}
