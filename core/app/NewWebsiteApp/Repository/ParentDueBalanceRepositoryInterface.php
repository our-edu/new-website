<?php

declare(strict_types = 1);

namespace App\AutomaticPaymentApp\Repository;

use App\AutomaticPaymentApp\Models\ParentDueBalance;
use App\BaseApp\Repository\BaseRepositoryInterface;

interface ParentDueBalanceRepositoryInterface extends BaseRepositoryInterface
{
    public function create(array $attributes): ParentDueBalance;

    public function find($id, $columns = ['*']): ParentDueBalance;
}
