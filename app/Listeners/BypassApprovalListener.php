<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Services\Vacation\BypassApprovalService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Events\VacationRequestCreatedEvent;

class BypassApprovalListener
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private BypassApprovalService $bypassApprovalService;

    public function __construct(BypassApprovalService $bypassApprovalService)
    {
        $this->bypassApprovalService = $bypassApprovalService;
    }

    public function handle(VacationRequestCreatedEvent $event)
    {
        $this->bypassApprovalService->bypassApproveVacationRequest($event->getVacationRequestId(), $event->getUser());
    }
}
