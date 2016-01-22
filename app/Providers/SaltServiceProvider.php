<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SaltServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
          'App\Http\Contracts\Salt',
          'App\Http\Controllers\SaltsController'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
