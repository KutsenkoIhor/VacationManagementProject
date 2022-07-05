<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\CancelVacationRequestEvent;
use App\Services\Notification\CancelVacationRequestNotificationService;
use App\Services\Vacation\VacationRequestService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CancelVacationRequestListener
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private VacationRequestService $vacationRequestService;
    private CancelVacationRequestNotificationService $cancelVacationRequestNotificationService;

    public function __construct(
        VacationRequestService $vacationRequestService,
        CancelVacationRequestNotificationService $cancelVacationRequestNotificationService
    ) {
        $this->vacationRequestService = $vacationRequestService;
        $this->cancelVacationRequestNotificationService = $cancelVacationRequestNotificationService;
    }

    public function handle(CancelVacationRequestEvent $event)
    {
        $this->cancelVacationRequestNotificationService->notify($event->getVacationRequest(), $event->getUserId());
    }
}
