<?php

declare(strict_types = 1);

namespace App\AutomaticPaymentApp\Models;

use App\BaseApp\BaseModel;

class ParentPaymentTransaction extends BaseModel
{
    protected $table = 'parent_payments_transactions';

    protected $fillable =[
        'parent_name',
        'national_id',
        'balance',
        'email',
        'paid_amount',
        'payfort_response',
        'paid'
    ];
}
