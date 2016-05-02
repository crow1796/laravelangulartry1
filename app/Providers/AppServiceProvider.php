<?php

namespace App\Providers;

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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Eloquent\FileRepository', 'App\Repositories\Eloquent\FileRepository');
        $this->app->bind('App\FileManager\FileManager', 'App\FileManager\FileManager');
    }
}
