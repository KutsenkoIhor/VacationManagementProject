<?php

namespace App\Providers;

use App\Events\ApproveVacationRequestEvent;
use App\Events\CreateVacationRequestApprovalEvent;
use App\Events\DenyVacationRequestEvent;
use App\Events\VacationRequestCreatedEvent;
use App\Listeners\ApproveVacationRequestListener;
use App\Listeners\BypassApprovalListener;
use App\Listeners\CheckVacationRequestListener;
use App\Listeners\CreateVacationListener;
use App\Listeners\DenyVacationRequestListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CreateVacationRequestApprovalEvent::class => [
            CheckVacationRequestListener::class,
        ],
        DenyVacationRequestEvent::class => [
            DenyVacationRequestListener::class,
        ],
        ApproveVacationRequestEvent::class => [
            ApproveVacationRequestListener::class,
            CreateVacationListener::class,
        ],
        VacationRequestCreatedEvent::class => [
            BypassApprovalListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
