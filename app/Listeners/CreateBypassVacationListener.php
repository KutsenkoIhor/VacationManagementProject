<?php

declare(strict_types = 1);

namespace App\Listeners;

use App\Events\BypassApprovalVacationRequestEvent;
use App\Services\Vacation\VacationService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateBypassVacationListener
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private VacationService $service;

    public function __construct(VacationService $service)
    {
        $this->service = $service;
    }

    public function handle(BypassApprovalVacationRequestEvent $event)
    {
        $this->service->createVacation($event->getVacationRequestId());
    }
}
