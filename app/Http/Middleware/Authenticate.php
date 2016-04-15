<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/auth/login');
            }
        }

        /* 通过 Auth 门面获取认证用户 */
        $user = Auth::user();
        if ($user->status == User::STATUS_DISABLE) {
            Auth::logout();
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/auth/login');
            }
        }

        $user->last_ip = $request->ip();
        $user->last_login_at = date('Y-m-d H:i:s');
        $user->save();

        return $next($request);
    }
}
