<?php

declare(strict_types = 1);

namespace App\Mail;

use App\DTO\VacationRequestDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApproveVacationRequestEmail extends Mailable
{
    use Queueable, SerializesModels;

    private VacationRequestDTO $vacationRequestDTO;

    public function __construct(VacationRequestDTO $vacationRequestDTO)
    {
        $this->vacationRequestDTO = $vacationRequestDTO;
    }

    public function build()
    {
        $address = 'valeriia.skliarenko@quantox.com';
        $subject = 'This is a demo!';
        $name = 'Quantox';

        return $this->view('emails.approve_vacation_request_email')
            ->from($address, $name)
            ->cc($address, $name)
            ->bcc($address, $name)
            ->replyTo($address, $name)
            ->subject($subject)
            ->with([ 'vac_id' => $this->vacationRequestDTO->getId() ]);
    }
}
