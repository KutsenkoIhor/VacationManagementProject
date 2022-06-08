<?php

declare(strict_types = 1);

namespace App\Listeners;

use App\Events\ApproveVacationRequestEvent;
use App\Services\Vacation\VacationRequestService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApproveVacationRequestListener
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private VacationRequestService $vacationRequestService;

    public function __construct(VacationRequestService $vacationRequestService)
    {
        $this->vacationRequestService = $vacationRequestService;
    }

    public function handle(ApproveVacationRequestEvent $event)
    {
        $this->vacationRequestService->approveVacationRequest($event->getVacationRequestId());
    }
}
