<?php

declare(strict_types = 1);

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();


        $this->routes(function () {
            if (env('PRODUCTION_LOAD_BALANCER') == 'alb') {
                $prefix = env('PRODUCTION_APP_PREFIX');
                Route::prefix("$prefix/api/v1/{language}")
                    ->middleware(['api','Locale'])
                    ->namespace($this->namespace)
                    ->group(base_path('routes/api.php'));
            } else {
                Route::prefix('api/v1/{language}')
                    ->middleware(['api','Locale'])
                    ->namespace($this->namespace)
                    ->group(base_path('routes/api.php'));
            }

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60);
        });
    }
    /**
     * Define the "tenant" routes for the application.
     *
     * These routes all receive session state, CSRF protection, Tenant Aware, etc.
     *
     * @return void
     */
}
