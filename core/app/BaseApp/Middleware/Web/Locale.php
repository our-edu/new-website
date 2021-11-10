<?php

declare(strict_types = 1);

namespace App\BaseApp\Middleware\Web;

use Closure;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if we're still using this alb => increment the segment
        if (env('PRODUCTION_LOAD_BALANCER') == 'alb') {
            // URL format $prefix/{language}/
            $languageCode = $request->segment(2);
        } else {
            // URL format /{language}/
            $languageCode = $request->segment(1);
        }

        $availableLocales = config("translatable.locales");
        $languageCode = strtolower($languageCode);

        if (!in_array($languageCode, $availableLocales)) {
            $languageCode = env('DEFAULT_LANGUAGE', 'ar');
        }
        LaravelLocalization::setLocale($languageCode);

        $request->route()->forgetParameter('language');
        return $next($request);
    }
}
