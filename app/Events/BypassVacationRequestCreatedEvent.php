<?php

declare(strict_types=1);

namespace App\Events;

use App\DTO\UserDTO;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BypassVacationRequestCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $vacationRequestId;
    public UserDTO $userDTO;

    public function __construct(int $vacationRequestId, UserDTO $userDTO)
    {
        $this->vacationRequestId = $vacationRequestId;
        $this->userDTO = $userDTO;
    }

    public function getVacationRequestId(): int
    {
        return $this->vacationRequestId;
    }

    public function getUser(): UserDTO
    {
        return $this->userDTO;
    }
}
