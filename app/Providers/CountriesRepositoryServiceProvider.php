<?php

namespace App\Providers;

use App\Interfaces\CountryRepositoryInterface;
use App\Repositories\CountryRepository;
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
