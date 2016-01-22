<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ClassesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->app->bind(
          'App\Http\Contracts\Classes',
          'App\Http\Controllers\ClassesController'
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
