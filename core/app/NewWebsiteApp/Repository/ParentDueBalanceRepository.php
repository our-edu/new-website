<?php

declare(strict_types = 1);

namespace App\AutomaticPaymentApp\Repository;

use App\AutomaticPaymentApp\Models\ParentDueBalance;
use App\BaseApp\Repository\Repository;

class ParentDueBalanceRepository extends Repository implements ParentDueBalanceRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model() :string
    {
        return ParentDueBalance::class;
    }

    public function find($id, $columns = ['*']): ParentDueBalance
    {
        return self::find($id, $columns);
    }


    public function create(array $attributes): ParentDueBalance
    {
        return self::create($attributes);
    }
}
