<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ManufacturerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
          'App\Http\Contracts\Manufacturer',
          'App\Http\Controllers\ManufacturerController'
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
