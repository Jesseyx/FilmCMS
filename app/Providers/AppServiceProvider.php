<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // 为视图组件附加登录的 user 对象
        // composer 会在视图每次渲染时都做绑定
//        view()->composer('*', function ($view) {
//            $view->with('_user', Auth::user());
//        });
        view()->share('_user', Auth::user());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
