<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\EditVacationRequestEvent;
use App\Services\Notification\EditVacationRequestNotificationService;
use App\Services\Vacation\VacationRequestService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EditVacationRequestListener
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private VacationRequestService $vacationRequestService;
    private EditVacationRequestNotificationService $editVacationRequestNotificationService;

    public function __construct(
        VacationRequestService $vacationRequestService,
        EditVacationRequestNotificationService $editVacationRequestNotificationService
    ) {
        $this->vacationRequestService = $vacationRequestService;
        $this->editVacationRequestNotificationService = $editVacationRequestNotificationService;
    }

    public function handle(EditVacationRequestEvent $event)
    {
        $this->editVacationRequestNotificationService->notify($event->getVacationRequest(), $event->getUserId());
    }
}
