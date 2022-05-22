<?php

declare(strict_types = 1);

namespace App\Listeners;

use App\Events\CreateVacationApprovalEvent;
use App\Services\Vacation\VacationApprovalService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CheckVacationRequestsListener
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private VacationApprovalService $vacationApprovalService;

    public function __construct(VacationApprovalService $vacationApprovalService)
    {
        $this->vacationApprovalService = $vacationApprovalService;
    }

    public function handle(CreateVacationApprovalEvent $event)
    {
        $this->vacationApprovalService->approveVacation($event->getVacationId());
    }
}
