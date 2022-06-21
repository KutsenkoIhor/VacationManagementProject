<?php

declare(strict_types=1);

namespace App\Notifications;

use App\DTO\VacationRequestDTO;
use App\Mail\ApproveVacationRequestEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ApproveVacationRequestNotification extends Notification
{
    use Queueable;

    private VacationRequestDTO $vacationRequestDTO;

    public function __construct(VacationRequestDTO $vacationRequestDTO)
    {
        $this->vacationRequestDTO = $vacationRequestDTO;
    }

    public function via()
    {
        return ['mail'];
    }

    public function toMail()
    {
        return new ApproveVacationRequestEmail($this->vacationRequestDTO);
    }
}
