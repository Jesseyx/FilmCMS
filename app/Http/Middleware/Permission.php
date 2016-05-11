<?php

namespace App\Http\Middleware;

use Closure;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $action = app('request')->route()->getAction();
        $action = $request->route()->getAction();
        // $action['controller'] = 'App\Http\Controllers\Home\HomeController@index';
        $controller = substr($action['controller'], 21);

        list($controller, $action) = explode('@', $controller);

        if (!\App\Facades\Permission::check(str_replace('Controller', '', $controller), $action)) {
            if ($request->ajax()) {
                return response()->json(['status' => '403', 'msg' => '您无权访问该模块，请联系管理员，谢谢！']);
            }

            abort(403, '您无权访问该模块，请联系管理员，谢谢！');
        }

        return $next($request);
    }
}
