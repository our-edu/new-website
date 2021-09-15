<?php

declare(strict_types = 1);

namespace App\BaseApp\Middleware;

use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class TypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $allowedTypes)
    {
        if ($user = Auth::user() ?? Auth::guard('api')->user()) {
            $allowedTypes = explode('|', $allowedTypes);
            if (in_array($user->type, $allowedTypes)) {
                return $next($request);
            }
        }

        if ($request->wantsJson()) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    [
                        'status' => 403,
                        'title' => trans('app.Unauthorized action'),
                        'detail' => trans('app.check your user type privileges')
                    ]
                ]
            ], 403));
        }

        session()->flash(trans('app.Models type is not authorized'));
        return redirect('/');
    }
}
