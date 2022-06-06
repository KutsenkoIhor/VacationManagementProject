<?php

namespace App\Providers;

use App\Repositories\Interfaces\ListEmployees\ListEmployeesVacationDaysLeftRepositoryInterface;
use App\Repositories\Interfaces\ListEmployees\ListEmployeesVacationDaysPerYearRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\VacationDaysLeftRepositoryRepository;
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
            ListEmployeesVacationDaysPerYearRepositoryInterface::class,
            VacationDaysPerYearRepository::class
        );

        $this->app->bind(
            ListEmployeesVacationDaysLeftRepositoryInterface::class,
            VacationDaysLeftRepositoryRepository::class
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
