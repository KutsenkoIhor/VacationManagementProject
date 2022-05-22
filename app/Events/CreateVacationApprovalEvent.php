<?php

declare(strict_types=1);

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateVacationApprovalEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $vacationId;

    public function __construct(int $vacationId)
    {
        $this->vacationId = $vacationId;
    }

    public function getVacationId(): int
    {
        return $this->vacationId;
    }
}
