<?php

declare(strict_types=1);

namespace App\Events;

use App\DTO\VacationDTO;
use App\DTO\VacationRequestDTO;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateVacationRequestEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public VacationRequestDTO $vacationRequestDTO;

    public function __construct(VacationRequestDTO $vacationRequestDTO)
    {
        $this->vacationRequestDTO = $vacationRequestDTO;
    }

    public function getVacationRequest(): VacationRequestDTO
    {
        return $this->vacationRequestDTO;
    }
}
