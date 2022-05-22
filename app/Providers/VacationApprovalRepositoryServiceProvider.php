<?php

namespace App\Providers;

use App\Factories\HomePageFactory;
use App\Factories\VacationApprovalFactory;
use App\Factories\VacationFactory;
use App\Repositories\Interfaces\VacationApprovalRepositoryInterface;
use App\Repositories\Interfaces\VacationRepositoryInterface;
use App\Repositories\Vacation\VacationApprovalRepository;
use App\Services\Vacation\VacationApprovalService;
use Illuminate\Support\ServiceProvider;

class VacationApprovalRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Repositories
        $this->app->singleton(VacationApprovalRepositoryInterface::class, function ($app) {
            return new VacationApprovalRepository(
                new VacationApprovalFactory(
                    $app->make(HomePageFactory::class),
                    $app->make(VacationFactory::class)
                ));
        });

        //Services
        $this->app->singleton(VacationApprovalService::class, function ($app) {
            return new VacationApprovalService(
                $app->make(VacationApprovalRepositoryInterface::class),
                $app->make(VacationRepositoryInterface::class)
            );
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
