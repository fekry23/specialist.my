<?php

namespace App\Providers;

use App\Models\activeJob;
use App\Observers\activeJobObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        activeJob::observe(activeJobObserver::class);
        Paginator::useTailwind();
    }
}
