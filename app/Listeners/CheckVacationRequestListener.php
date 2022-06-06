<?php

declare(strict_types = 1);

namespace App\Listeners;

use App\Events\CreateVacationRequestApprovalEvent;
use App\Services\Vacation\VacationRequestApprovalService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CheckVacationRequestListener
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private VacationRequestApprovalService $vacationRequestApprovalService;

    public function __construct(VacationRequestApprovalService $vacationRequestApprovalService)
    {
        $this->vacationRequestApprovalService = $vacationRequestApprovalService;
    }

    public function handle(CreateVacationRequestApprovalEvent $event)
    {
        $this->vacationRequestApprovalService->approveVacationRequest($event->getVacationRequestId());
    }
}
