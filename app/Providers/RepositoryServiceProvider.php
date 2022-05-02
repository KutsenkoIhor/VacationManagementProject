<?php

namespace App\Providers;

use App\Repositories\Interfaces\HomePageRepositoryInterface;
use App\Repositories\Interfaces\SocialRepositoryInterface;
use App\Repositories\HomePageRepository;
use App\Repositories\SocialRepository;
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
