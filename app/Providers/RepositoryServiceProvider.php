<?php

namespace App\Providers;

use App\Repositories\CitiesRepository;
use App\Repositories\CityHrRepository;
use App\Repositories\CountriesRepository;
use App\Repositories\CountryHolidayRepository;
use App\Repositories\Interfaces\CitiesRepositoryInterface;
use App\Repositories\Interfaces\CityHrRepositoryInterface;
use App\Repositories\Interfaces\CountriesRepositoryInterface;
use App\Repositories\Interfaces\CountryHolidayRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\DomainsRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\VacationDaysLeftRepositoryInterface;
use App\Repositories\Interfaces\VacationDaysPerYearRepositoryInterface;
use App\Repositories\Interfaces\VacationRepositoryInterface;
use App\Repositories\Interfaces\VacationRequestApprovalRepositoryInterface;
use App\Repositories\Interfaces\VacationRequestRepositoryInterface;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Repositories\VacationDaysLeftRepository;
use App\Repositories\VacationDaysPerYearRepository;
use App\Repositories\VacationRepository;
use App\Repositories\VacationRequestApprovalRepository;
use App\Repositories\VacationRequestRepository;
use App\Repositories\DomainsRepository;
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
            CitiesRepositoryInterface::class,
            CitiesRepository::class
        );

        $this->app->bind(
            CountriesRepositoryInterface::class,
            CountriesRepository::class
        );

        $this->app->bind(
            CountryHolidayRepositoryInterface::class,
            CountryHolidayRepository::class
        );

        $this->app->bind(
            DomainsRepositoryInterface::class,
            DomainsRepository::class
        );

        $this->app->bind(
            RoleRepositoryInterface::class,
            RoleRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            VacationDaysLeftRepositoryInterface::class,
            VacationDaysLeftRepository::class
        );

        $this->app->bind(
            VacationDaysPerYearRepositoryInterface::class,
            VacationDaysPerYearRepository::class
        );

        $this->app->bind(
            VacationRepositoryInterface::class,
            VacationRepository::class
        );

        $this->app->bind(
            VacationRequestApprovalRepositoryInterface::class,
            VacationRequestApprovalRepository::class
        );

        $this->app->bind(
            VacationRequestRepositoryInterface::class,
            VacationRequestRepository::class
        );

        $this->app->bind(
            CityHrRepositoryInterface::class,
            CityHrRepository::class
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
