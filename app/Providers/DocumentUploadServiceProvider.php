<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DocumentUploadServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
          'App\Http\Contracts\DocumentUpload',
          'App\Http\Controllers\DocumentUploadController'
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
