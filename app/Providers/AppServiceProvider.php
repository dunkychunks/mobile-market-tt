<?php

namespace App\Providers;

use App\Events\OrderPaid;
use App\Helpers\CustomHelper;
use App\Listeners\UpdateUserTier;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('helper', function () {
            return new CustomHelper();
        });
    }

    public function boot(): void
    {
        Paginator::useBootstrapFour();

        Event::listen(
            OrderPaid::class,
            UpdateUserTier::class,
        );
    }
}
