<?php

namespace App\Providers;

use App\Services\PermissionCheck;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('permission', function ($app) {
            return new PermissionCheck();
        });
    }
}
