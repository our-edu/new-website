<?php

namespace App\BaseApp\Providers;

use RdKafka\Conf;
use RdKafka\Producer;
use Illuminate\Support\ServiceProvider;

class ProducerServiceProvider extends ServiceProvider
{
    /**
     * Boot method
     *
     * @return void
     */
    public function boot()
    {

    }
}
