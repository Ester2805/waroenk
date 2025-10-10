<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

// make sure to import the middleware class when referencing it by class name

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register route middleware alias for admin
        if (class_exists(\App\Http\Middleware\AdminMiddleware::class)) {
            Route::aliasMiddleware('admin', \App\Http\Middleware\AdminMiddleware::class);
        }
    }
}
