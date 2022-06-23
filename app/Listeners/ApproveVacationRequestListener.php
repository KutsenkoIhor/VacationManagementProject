<?php

declare(strict_types = 1);

namespace App\Listeners;

use App\Events\ApproveVacationRequestEvent;
use App\Services\Notification\ApproveVacationRequestNotificationService;
use App\Services\Vacation\VacationRequestService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApproveVacationRequestListener
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private VacationRequestService $vacationRequestService;
    private ApproveVacationRequestNotificationService $approveVacationRequestNotificationService;

    public function __construct(
        VacationRequestService $vacationRequestService,
        ApproveVacationRequestNotificationService $approveVacationRequestNotificationService
    ) {
        $this->vacationRequestService = $vacationRequestService;
        $this->approveVacationRequestNotificationService = $approveVacationRequestNotificationService;
    }


    public function handle(ApproveVacationRequestEvent $event)
    {
        $vacationRequestDTO = $this->vacationRequestService->approveVacationRequest($event->getVacationRequestId());

        $this->approveVacationRequestNotificationService->notify($vacationRequestDTO);
    }
}
