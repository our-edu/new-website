<?php
declare(strict_types = 1);

namespace App\AutomaticPaymentApp\Models;

use App\BaseApp\BaseModel;

class ParentDueBalance extends BaseModel
{
    protected $table = 'parent_due_balances';

    protected $fillable =[
        'parent_name',
        'national_id',
        'balance',
        'email'
    ];

    /**
     * @param $value
     * @return float|int
     */
    public function getBalanceAttribute($value): float|int
    {
        return  $value / 1000 ;
    }

    /**
     * @param $value
     */
    public function setBalanceAttribute($value)
    {
        $this->attributes['balance'] = $value * 1000;
    }
}
