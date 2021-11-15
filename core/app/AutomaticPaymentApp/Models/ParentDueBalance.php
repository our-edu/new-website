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
}
