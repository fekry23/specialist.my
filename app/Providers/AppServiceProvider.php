<?php

namespace App\Providers;

use App\Models\activeJob;
use App\Models\Employer;
use App\Models\Trainer;
use Laravel\Cashier\Cashier;
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
        Cashier::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        activeJob::observe(activeJobObserver::class);
        Cashier::useCustomerModel(Employer::class);
        Cashier::useCustomerModel(Trainer::class);
        Paginator::useTailwind();
    }
}
