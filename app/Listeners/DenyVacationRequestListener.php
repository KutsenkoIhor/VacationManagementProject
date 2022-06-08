<?php

declare(strict_types = 1);

namespace App\Listeners;

use App\Events\DenyVacationRequestEvent;
use App\Services\Vacation\VacationRequestService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DenyVacationRequestListener
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private VacationRequestService $vacationRequestService;

    public function __construct(VacationRequestService $vacationRequestService)
    {
        $this->vacationRequestService = $vacationRequestService;
    }

    public function handle(DenyVacationRequestEvent $event)
    {
        $this->vacationRequestService->denyVacationRequest($event->getVacationRequestId());
    }
}
