<?php

namespace App\Providers;

use App\Helpers\CustomHelper;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind to the Service Container
        $this->app->singleton('helper', function () {
            return new CustomHelper();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        // Laravel Pagination: https://laravel.com/docs/12.x/pagination#using-bootstrap
        // Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
