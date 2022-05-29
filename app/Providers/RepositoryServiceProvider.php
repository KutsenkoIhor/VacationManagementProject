<?php

namespace App\Providers;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\VacationDaysLeftInterface;
use App\Repositories\Interfaces\VacationDaysPerYearRepositoryInterface;
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
