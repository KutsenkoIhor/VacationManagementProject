<?php

namespace App\Providers;

use App\Repositories\Interfaces\HomePageRepositoryInterface;
use App\Repositories\Interfaces\SocialRepositoryInterface;
use App\Repositories\Interfaces\DomainsRepositoryInterface;
use App\Repositories\HomePageRepository;
use App\Repositories\SocialRepository;
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
            DomainsRepositoryInterface::class,
            DomainsRepository::class
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
