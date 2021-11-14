<?php

declare(strict_types = 1);

namespace App\BaseApp\PayFort\Facades;

use Illuminate\Support\Facades\Facade;

class Payfort extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\BaseApp\PayFort\PayfortFacadeAccessor';
    }
}
