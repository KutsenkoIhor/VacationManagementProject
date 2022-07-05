<?php

declare(strict_types=1);

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApproveVacationRequestEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $vacationRequestId;
    public int $userId;

    public function __construct(int $vacationRequestId, int $userId)
    {
        $this->vacationRequestId = $vacationRequestId;
        $this->userId = $userId;
    }

    public function getVacationRequestId(): int
    {
        return $this->vacationRequestId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
