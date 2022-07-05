<?php

declare(strict_types=1);

namespace App\Events;

use App\DTO\VacationRequestDTO;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EditVacationRequestEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public VacationRequestDTO $vacationRequestDTO;
    public int $userId;

    public function __construct(VacationRequestDTO $vacationRequestDTO, int $userId)
    {
        $this->vacationRequestDTO = $vacationRequestDTO;
        $this->userId = $userId;
    }

    public function getVacationRequest(): VacationRequestDTO
    {
        return $this->vacationRequestDTO;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
