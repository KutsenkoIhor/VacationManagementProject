<?php

declare(strict_types=1);

namespace App\Notifications;

use App\DTO\UserDTO;
use App\DTO\VacationRequestDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CancelVacationRequestNotification extends Notification
{
    use Queueable;

    private VacationRequestDTO $vacationRequestDTO;
    private UserDTO $userDTO;

    public function __construct(VacationRequestDTO $vacationRequestDTO, UserDTO $userDTO)
    {
        $this->vacationRequestDTO = $vacationRequestDTO;
        $this->userDTO = $userDTO;
    }

    public function via()
    {
        return ['mail'];
    }

    public function toMail()
    {
        return (new MailMessage())
            ->view(
                'emails.cancel_vacation_request_email',
                [
                    'employee_last_name'      => $this->vacationRequestDTO->getUser()->getLastName(),
                    'employee_first_name'     => $this->vacationRequestDTO->getUser()->getFirstName(),
                    'start_date'              => $this->vacationRequestDTO->getStartDate()->format('Y-m-d'),
                    'end_date'                =>  $this->vacationRequestDTO->getEndDate()->format('Y-m-d'),
                    'cancelled_by_last_name'  => $this->userDTO->getLastName(),
                    'cancelled_by_first_name' => $this->userDTO->getFirstName()
                ]
            );
    }
}
