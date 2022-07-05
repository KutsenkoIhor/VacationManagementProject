<?php

declare(strict_types=1);

namespace App\Notifications;

use App\DTO\VacationRequestDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateVacationRequestNotification extends Notification
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
        return (new MailMessage())
            ->view(
                'emails.create_vacation_request_email',
                [
                    'last_name'  => $this->vacationRequestDTO->getUser()->getLastName(),
                    'first_name' => $this->vacationRequestDTO->getUser()->getFirstName(),
                    'start_date' => $this->vacationRequestDTO->getStartDate()->format('Y-m-d'),
                    'end_date'   =>  $this->vacationRequestDTO->getEndDate()->format('Y-m-d')
                ]
            );
    }
}
