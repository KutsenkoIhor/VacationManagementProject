<?php

declare(strict_types = 1);

namespace App\Listeners;

use App\Events\ApproveVacationRequestEvent;
use App\Notifications\ApproveVacationRequestNotification;
use App\Repositories\Interfaces\CityHrRepositoryInterface;
use App\Repositories\Interfaces\EmployeesAndPmRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Vacation\VacationRequestService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class ApproveVacationRequestListener
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private VacationRequestService $vacationRequestService;
    private UserRepositoryInterface $userRepositoryInterface;
    private EmployeesAndPmRepositoryInterface $employeesAndPmRepositoryInterface;
    private CityHrRepositoryInterface $cityHrRepositoryInterface;

    public function __construct(
        VacationRequestService $vacationRequestService,
        UserRepositoryInterface $userRepositoryInterface,
        EmployeesAndPmRepositoryInterface $employeesAndPmRepositoryInterface,
        CityHrRepositoryInterface $cityHrRepositoryInterface
    )
    {
        $this->vacationRequestService = $vacationRequestService;
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->employeesAndPmRepositoryInterface = $employeesAndPmRepositoryInterface;
        $this->cityHrRepositoryInterface = $cityHrRepositoryInterface;
    }


    public function handle(ApproveVacationRequestEvent $event)
    {
        $vacationRequestDTO = $this->vacationRequestService->approveVacationRequest($event->getVacationRequestId());

//        $this->approveVacationRequestNotificationService()->notify($event->getVacationRequestId());

        //Here, we're forced to use Models instead of DTOs, cause Notifiable trait applied on Model level.
        //It's kinda brakes our Repository pattern. Sorry about that :(

        Notification::send(
            [
                $this->userRepositoryInterface->getUserModelById($vacationRequestDTO->getUser()->getId()),
                $this->employeesAndPmRepositoryInterface->getPMModelById($vacationRequestDTO->getUser()->getId()),
//                $this->cityHrRepositoryInterface->getHrModelById($vacationRequestDTO->getUser()->getId()),
                //TODO add hrModel and pmModel so they will also receive notification
            ],
            new ApproveVacationRequestNotification($vacationRequestDTO)
        );
    }
}
