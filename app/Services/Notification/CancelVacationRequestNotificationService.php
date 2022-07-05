<?php

declare(strict_types=1);


namespace App\Services\Notification;


use App\DTO\VacationRequestDTO;
use App\Notifications\CancelVacationRequestNotification;
use App\Repositories\Interfaces\CityHrRepositoryInterface;
use App\Repositories\Interfaces\EmployeesAndPmRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Notification;

class CancelVacationRequestNotificationService
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

    public function notify(VacationRequestDTO $vacationRequestDTO, int $userId): void
    {
        //Here, we're forced to use Models instead of DTOs, cause Notifiable trait applied on Model level.
        //It's kinda brakes our Repository pattern. Sorry about that :(

        $userDTO = $this->userRepositoryInterface->getUserParameters($userId);

        Notification::sendNow(
            [
                $this->userRepositoryInterface->getUserModelById($vacationRequestDTO->getUser()->getId()),
                $this->employeesAndPmRepositoryInterface->getPMModelById($vacationRequestDTO->getUser()->getId()),
                $this->cityHrRepositoryInterface->getHrAssignedToUser($vacationRequestDTO->getUser()->getCityId())
            ],
            new CancelVacationRequestNotification($vacationRequestDTO, $userDTO)
        );
    }

}
