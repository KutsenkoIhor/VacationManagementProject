<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Services\Vacation\BypassApprovalService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Events\BypassVacationRequestCreatedEvent;

class BypassVacationRequestCreatedListener
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private BypassApprovalService $bypassApprovalService;

    public function __construct(BypassApprovalService $bypassApprovalService)
    {
        $this->bypassApprovalService = $bypassApprovalService;
    }

    public function handle(BypassVacationRequestCreatedEvent $event)
    {
        $this->bypassApprovalService->bypassApproveVacationRequest($event->getVacationRequestId(), $event->getUser());
    }
}
