<?php

namespace App\Providers;

use App\Factories\HomePageFactory;
use App\Factories\VacationFactory;
use App\Interfaces\VacationRepositoryInterface;
use App\Repositories\Vacation\VacationRepository;
use App\Services\Vacation\VacationService;
use Illuminate\Support\ServiceProvider;

class VacationRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Repositories
        $this->app->singleton(VacationRepositoryInterface::class, function ($app) {
            return new VacationRepository(new VacationFactory($app->make(HomePageFactory::class)));
        });

        //Services
        $this->app->singleton(VacationService::class, function ($app) {
            return new VacationService($app->make(VacationRepositoryInterface::class));
        });
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
