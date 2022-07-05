<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\DenyVacationRequestEvent;
use App\Services\Notification\DenyVacationRequestNotificationService;
use App\Services\Vacation\VacationRequestService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DenyVacationRequestListener
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private VacationRequestService $vacationRequestService;
    private DenyVacationRequestNotificationService $denyVacationRequestNotificationService;

    public function __construct(
        VacationRequestService                 $vacationRequestService,
        DenyVacationRequestNotificationService $denyVacationRequestNotificationService
    )
    {
        $this->vacationRequestService = $vacationRequestService;
        $this->denyVacationRequestNotificationService = $denyVacationRequestNotificationService;
    }


    public function handle(DenyVacationRequestEvent $event)
    {
        $vacationRequestDTO = $this->vacationRequestService->denyVacationRequest($event->getVacationRequestId());

        $this->denyVacationRequestNotificationService->notify($vacationRequestDTO, $event->getUserId());
    }
}
