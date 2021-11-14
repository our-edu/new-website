<?php

declare(strict_types = 1);

namespace App\BaseApp\Enums;

abstract class PayFortStatusEnum
{
    const TOKENIZATION_SUCCESS = '02';
    const INVALID_REQUEST = '00';
    const ON_HOLD = '20';
    const PURCHASE_SUCCESS = '14';
    const SUCCESS = '02';
    const CAPTURE_SUCCESS = '04';
}
