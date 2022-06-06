<?php

namespace App\Providers;

use App\Repositories\Interfaces\CountryHolidayRepositoryInterface;
use App\Repositories\Interfaces\HomePageRepositoryInterface;
use App\Repositories\Interfaces\SocialRepositoryInterface;
use App\Repositories\Interfaces\DomainsRepositoryInterface;
use App\Repositories\HomePageRepository;
use App\Repositories\Interfaces\VacationRepositoryInterface;
use App\Repositories\Interfaces\VacationRequestApprovalRepositoryInterface;
use App\Repositories\Interfaces\VacationRequestRepositoryInterface;
use App\Repositories\Location\CountryHolidayRepository;
use App\Repositories\SocialRepository;
use App\Repositories\Vacation\VacationRepository;
use App\Repositories\Vacation\VacationRequestApprovalRepository;
use App\Repositories\Vacation\VacationRequestRepository;
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
            SocialRepositoryInterface::class,
            SocialRepository::class
        );

        $this->app->bind(
            HomePageRepositoryInterface::class,
            HomePageRepository::class
        );

        $this->app->bind(
            VacationRequestRepositoryInterface::class,
            VacationRequestRepository::class
        );

        $this->app->bind(
            VacationRequestApprovalRepositoryInterface::class,
            VacationRequestApprovalRepository::class
        );

        $this->app->bind(
            VacationRepositoryInterface::class,
            VacationRepository::class
        );

        $this->app->bind(
            DomainsRepositoryInterface::class,
            DomainsRepository::class
        );

        $this->app->bind(
            CountryHolidayRepositoryInterface::class,
            CountryHolidayRepository::class
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
