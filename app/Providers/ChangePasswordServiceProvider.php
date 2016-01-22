<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ChangePasswordServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->app->bind(
          'App\Http\Contracts\ChangePassword',
          'App\Http\Controllers\ChangePasswordController'
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
