<?php

declare(strict_types = 1);

namespace App\AutomaticPaymentApp\Repository;

use App\AutomaticPaymentApp\Models\ParentDueBalance;
use App\AutomaticPaymentApp\Models\ParentPaymentTransaction;
use App\BaseApp\Repository\Repository;

class ParentPaymentTransactionRepository extends Repository implements ParentPaymentTransactionRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model() :string
    {
        return ParentPaymentTransaction::class;
    }

    public function find($id, $columns = ['*']): ParentPaymentTransaction
    {
        return self::find($id, $columns);
    }


    public function create(array $attributes): ParentPaymentTransaction
    {
        return self::create($attributes);
    }
}
