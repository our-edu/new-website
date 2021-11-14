<?php

declare(strict_types = 1);

namespace App\BaseApp\PayFort\Providers;

use App\BaseApp\PayFort\Services\PayfortAPI;
use App\BaseApp\PayFort\Services\PayfortRedirection;
use Illuminate\Support\ServiceProvider;

class PayfortServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

//    private $configPath = __DIR__ . '/../../config/payfort.php';
//    private $translationsPath = __DIR__ . '/../../resources/lang';
//    private $viewsPath = __DIR__ . '/../../resources/views';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
//        # Add config file to service provider publish command
//        $this->publishes([
//            $this->configPath => config_path('payfort.php'),
//        ], 'config');
//
//        # Load package translation files
//        $this->loadTranslationsFrom($this->translationsPath, 'laravel-payfort');
//
//        # Load package views files
//        $this->loadViewsFrom($this->viewsPath, 'laravel-payfort');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//        \Log::debug('Registered');
        # Merge application and packages configurations
//        $this->mergeConfigFrom(
//            $this->configPath,
//            'payfort'
//        );

        $this->app->bind(PayfortAPI::class, function () {
            return new PayfortAPI(config('payfort'));
        });

        $this->app->bind(PayfortRedirection::class, function () {
            return new PayfortRedirection(config('payfort'));
        });
    }

//    /**
//     * Get the services provided by the provider.
//     *
//     * @return array
//     */
//    public function provides()
//    {
//        \Log::debug('provides');
//        return ['LaravelPayfort\Facades\Payfort'];
//    }
}
