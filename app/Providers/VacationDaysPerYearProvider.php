<?php

namespace App\Providers;

use App\Repositories\Interfaces\ListEmployees\ListEmployeesVacationDaysPerYearRepositoryInterface;
use App\Repositories\VacationDaysPerYearRepository;
use Illuminate\Support\ServiceProvider;

class VacationDaysPerYearProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            ListEmployeesVacationDaysPerYearRepositoryInterface::class,
            VacationDaysPerYearRepository::class
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
