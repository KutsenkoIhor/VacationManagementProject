<?php

declare(strict_types=1);


namespace App\Providers;

use App\Factories\VacationFactory;
use App\Factories\VacationRequestApprovalFactory;
use App\Factories\VacationRequestFactory;
use Illuminate\Support\ServiceProvider;

class FactoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            VacationRequestFactory::class,
            VacationRequestFactory::class
        );

        $this->app->bind(
            VacationFactory::class,
            VacationFactory::class
        );

        $this->app->bind(
            VacationRequestApprovalFactory::class,
            VacationRequestApprovalFactory::class
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
