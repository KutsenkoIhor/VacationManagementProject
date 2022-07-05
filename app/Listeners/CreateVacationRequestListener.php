<?php

declare(strict_types = 1);

namespace App\Listeners;

use App\Events\CreateVacationRequestEvent;
use App\Services\Notification\CreateVacationRequestNotificationService;
use App\Services\Vacation\VacationRequestService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateVacationRequestListener
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private VacationRequestService $vacationRequestService;
    private CreateVacationRequestNotificationService $createVacationRequestNotificationService;

    public function __construct(
        VacationRequestService $vacationRequestService,
        CreateVacationRequestNotificationService $createVacationRequestNotificationService
    ) {
        $this->vacationRequestService = $vacationRequestService;
        $this->createVacationRequestNotificationService = $createVacationRequestNotificationService;
    }

    public function handle(CreateVacationRequestEvent $event)
    {
        $this->createVacationRequestNotificationService->notify($event->getVacationRequest());
    }
}
