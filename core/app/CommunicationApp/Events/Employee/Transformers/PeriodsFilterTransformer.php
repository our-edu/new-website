<?php

declare(strict_types = 1);

namespace App\CommunicationApp\Events\Employee\Transformers;

use App\BaseApp\Models\Branch;

class PeriodsFilterTransformer
{
    public $filter_key = 'key';

    public function value($period): array
    {
        return [
            'name' =>  (string) $period['name']
        ];
    }

    public function valueKeys(): array
    {
        return [
            'name'
        ];
    }
}
