<?php

declare(strict_types = 1);

namespace App\AutomaticPaymentApp\Front\Enums;

abstract class ExternalApiEnums
{
    public const NATIONAL_ID_CHECK_LOCAL = 'http://localhost:8003/api/v1/{lang}/national_id_exist?national_id={national_id}';
}
