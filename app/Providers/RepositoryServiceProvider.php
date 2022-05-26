<?php

namespace App\Providers;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\VacationDaysLeftInterface;
use App\Interfaces\VacationDaysPerYearRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\VacationDaysLeftRepository;
use App\Repositories\VacationDaysPerYearRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            VacationDaysPerYearRepositoryInterface::class,
            VacationDaysPerYearRepository::class
        );

        $this->app->bind(
            VacationDaysLeftInterface::class,
            VacationDaysLeftRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
