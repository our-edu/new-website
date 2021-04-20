<?php

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

        // case api request
        if ($request->wantsJson()) {
           throw new HttpResponseException(response()->json([
                "errors" => [
                    [
                        'status' => 403,
                        'title' => 'unauthorized_action',
                        'detail' => trans('app.Unauthorized action')
                    ]
                ]
            ], 403));
        }

       session()->flash(trans('app.Models type is not authorized'));
        return redirect('/');
    }
}
