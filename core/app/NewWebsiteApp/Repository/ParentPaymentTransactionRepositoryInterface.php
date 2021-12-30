<?php

declare(strict_types = 1);

namespace App\AutomaticPaymentApp\Repository;

use App\AutomaticPaymentApp\Models\ParentPaymentTransaction;
use App\BaseApp\Repository\BaseRepositoryInterface;

interface ParentPaymentTransactionRepositoryInterface extends BaseRepositoryInterface
{
    public function create(array $attributes): ParentPaymentTransaction;

    public function find($id, $columns = ['*']): ParentPaymentTransaction;
}
