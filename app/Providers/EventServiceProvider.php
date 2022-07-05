<?php

namespace App\Providers;

use App\Events\ApproveVacationRequestEvent;
use App\Events\BypassApprovalVacationRequestEvent;
use App\Events\CancelVacationRequestEvent;
use App\Events\CreateVacationRequestApprovalEvent;
use App\Events\CreateVacationRequestEvent;
use App\Events\DenyVacationRequestEvent;
use App\Events\BypassVacationRequestCreatedEvent;
use App\Events\EditVacationRequestEvent;
use App\Listeners\ApproveVacationRequestListener;
use App\Listeners\BypassApprovalVacationRequestListener;
use App\Listeners\BypassVacationRequestCreatedListener;
use App\Listeners\CancelVacationRequestListener;
use App\Listeners\CheckVacationRequestListener;
use App\Listeners\CreateBypassVacationListener;
use App\Listeners\CreateVacationListener;
use App\Listeners\CreateVacationRequestListener;
use App\Listeners\DenyVacationRequestListener;
use App\Listeners\EditVacationRequestListener;
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
        BypassVacationRequestCreatedEvent::class => [
            BypassVacationRequestCreatedListener::class
        ],
        BypassApprovalVacationRequestEvent::class => [
            BypassApprovalVacationRequestListener::class,
            CreateBypassVacationListener::class
        ],
        CreateVacationRequestEvent::class => [
            CreateVacationRequestListener::class
        ],
        EditVacationRequestEvent::class => [
            EditVacationRequestListener::class
        ],
        CancelVacationRequestEvent::class => [
            CancelVacationRequestListener::class
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
