<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\PrimeYearRepository;
use App\Repositories\PrimeYearRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PrimeYearRepositoryInterface::class, PrimeYearRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
