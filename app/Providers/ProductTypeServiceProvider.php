<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ProductTypeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
          'App\Http\Contracts\ProductType',
          'App\Http\Controllers\ProductTypeController'
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
