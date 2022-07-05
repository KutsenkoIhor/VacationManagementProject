<?php

declare(strict_types = 1);

namespace App\Listeners;

use App\Events\ApproveVacationRequestEvent;
use App\Services\Vacation\VacationService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateVacationListener
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private VacationService $vacationService;

    public function __construct(VacationService $vacationService)
    {
        $this->vacationService = $vacationService;
    }

    public function handle(ApproveVacationRequestEvent $approveVacationRequestEvent)
    {
        $this->vacationService->createVacation($approveVacationRequestEvent->getVacationRequestId());
    }
}
