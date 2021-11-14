<?php

declare(strict_types = 1);

namespace App\BaseApp\PayFort;

use App\BaseApp\PayFort\Services\PayfortAPI;
use App\BaseApp\PayFort\Services\PayfortRedirection;

class PayfortFacadeAccessor
{
    /**
     * Get Payfort API services provider
     *
     * @param array $extra_config Extra configurations
     * @return PayfortAPI
     */
    public static function api($extra_config = [])
    {
        $config = array_merge(config('payfort'), $extra_config);
        return new PayfortAPI($config);
    }

    /**
     * Get Payfort Redirection services provider
     *
     * @param array $extra_config Extra configurations
     * @return PayfortRedirection
     */
    public static function redirection($extra_config = [])
    {
        $config = array_merge(config('payfort'), $extra_config);
        return new PayfortRedirection($config);
    }
}
