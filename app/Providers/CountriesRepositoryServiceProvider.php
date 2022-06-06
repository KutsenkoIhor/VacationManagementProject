<?php

namespace App\Providers;

use App\Repositories\CountryRepository;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\ListEmployees\ListEmployeesCountryRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class CountriesRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CountryRepositoryInterface::class,
            CountryRepository::class
        );

        $this->app->bind(
            ListEmployeesCountryRepositoryInterface::class,
            CountryRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
