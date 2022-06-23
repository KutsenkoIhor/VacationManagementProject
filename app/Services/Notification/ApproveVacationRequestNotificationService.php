<?php

declare(strict_types=1);

namespace App\Services\Notification;

use App\DTO\VacationRequestDTO;
use App\Notifications\ApproveVacationRequestNotification;
use App\Repositories\Interfaces\CityHrRepositoryInterface;
use App\Repositories\Interfaces\EmployeesAndPmRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Notification;

class ApproveVacationRequestNotificationService
{
    private UserRepositoryInterface $userRepositoryInterface;
    private EmployeesAndPmRepositoryInterface $employeesAndPmRepositoryInterface;
    private CityHrRepositoryInterface $cityHrRepositoryInterface;

    public function __construct(
        UserRepositoryInterface $userRepositoryInterface,
        EmployeesAndPmRepositoryInterface $employeesAndPmRepositoryInterface,
        CityHrRepositoryInterface $cityHrRepositoryInterface
    ) {
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->employeesAndPmRepositoryInterface = $employeesAndPmRepositoryInterface;
        $this->cityHrRepositoryInterface = $cityHrRepositoryInterface;
    }

    public function notify(VacationRequestDTO $vacationRequestDTO): void
    {
        //Here, we're forced to use Models instead of DTOs, cause Notifiable trait applied on Model level.
        //It's kinda brakes our Repository pattern. Sorry about that :(

        Notification::send(
            [
                $this->userRepositoryInterface->getUserModelById($vacationRequestDTO->getUser()->getId()),
                $this->employeesAndPmRepositoryInterface->getPMModelById($vacationRequestDTO->getUser()->getId()),
                $this->cityHrRepositoryInterface->getHrAssignedToUser($vacationRequestDTO->getUser()->getCityId())
            ],
            new ApproveVacationRequestNotification($vacationRequestDTO)
        );
    }

}
