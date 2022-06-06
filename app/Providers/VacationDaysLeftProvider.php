<?php

namespace App\Providers;

use App\Repositories\Interfaces\ListEmployees\ListEmployeesVacationDaysLeftRepositoryInterface;
use App\Repositories\VacationDaysLeftRepositoryRepository;
use Illuminate\Support\ServiceProvider;

class VacationDaysLeftProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
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
