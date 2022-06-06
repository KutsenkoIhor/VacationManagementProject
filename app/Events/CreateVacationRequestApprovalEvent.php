<?php

declare(strict_types=1);

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateVacationRequestApprovalEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $vacationRequestId;

    public function __construct(int $vacationRequestId)
    {
        $this->vacationRequestId = $vacationRequestId;
    }

    public function getVacationRequestId(): int
    {
        return $this->vacationRequestId;
    }
}
