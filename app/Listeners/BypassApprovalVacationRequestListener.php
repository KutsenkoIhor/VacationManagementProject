<?php

declare(strict_types = 1);

namespace App\Listeners;

use App\Events\BypassApprovalVacationRequestEvent;
use App\Services\Vacation\VacationRequestService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BypassApprovalVacationRequestListener
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private VacationRequestService $vacationRequestService;

    public function __construct(VacationRequestService $vacationRequestService)
    {
        $this->vacationRequestService = $vacationRequestService;
    }

    public function handle(BypassApprovalVacationRequestEvent $event)
    {
        $this->vacationRequestService->approveVacationRequest($event->getVacationRequestId());
    }
}
