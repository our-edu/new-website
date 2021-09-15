<?php

declare(strict_types = 1);

namespace App\BaseApp\Middleware;

use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Middlewares\PermissionMiddleware as SpatiePermissionMiddleware;

class PermissionMiddleware extends SpatiePermissionMiddleware
{

    public function handle($request, Closure $next, $permission, $guard = null)
    {
        $authGuard = app('auth')->guard($guard);

        if ($authGuard->guest()) {
            throw UnauthorizcedException::notLoggedIn();
        }

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        foreach ($permissions as $permission) {
//            if ($authGuard->user()->can($permission)) {}
            $role = $authGuard->user()->roles()->where("branch_uuid", $authGuard->user()->employee->branch_id)->first();
            if ($role && $role->hasPermissionTo($permission)) {
                return $next($request);
            }
        }

        $message = 'User does not have the right permissions.';

        if (config('permission.display_permission_in_exception')) {
            $permStr = implode(', ', $permissions);
            $message = 'User does not have the right permissions. Necessary permissions are '.$permStr;
        }


        throw new HttpResponseException(response()->json([
            "errors" => [
                [
                    'status' => 403,
                    'title' => 'unauthorized_action',
                    'detail' => $message
                ]
            ]
        ], 403));
    }
}
