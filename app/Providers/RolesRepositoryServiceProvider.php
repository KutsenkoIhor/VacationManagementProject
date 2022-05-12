<?php

namespace App\Providers;

use App\Interfaces\RoleRepositoryInterface;
use App\Repositories\RoleRepository;
use Illuminate\Support\ServiceProvider;

class RolesRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            RoleRepositoryInterface::class,
            RoleRepository::class
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
