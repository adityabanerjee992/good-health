<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AilmentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->app->bind(
           'App\Http\Contracts\Ailment',
          'App\Http\Controllers\AilmentController'
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
