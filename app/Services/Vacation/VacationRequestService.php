<?php

declare(strict_types=1);

namespace App\Services\Vacation;

use App\DTO\VacationRequestDTO;
use App\Events\BypassVacationRequestCreatedEvent;
use App\Events\CancelVacationRequestEvent;
use App\Events\CreateVacationRequestEvent;
use App\Events\EditVacationRequestEvent;
use App\Repositories\Interfaces\CityHrRepositoryInterface;
use App\Repositories\Interfaces\EmployeesAndPmRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\VacationRepositoryInterface;
use App\Repositories\Interfaces\VacationRequestRepositoryInterface;
use Carbon\Carbon;

class VacationRequestService
{
    private VacationRequestRepositoryInterface $vacationRequestRepositoryInterface;
    private VacationRepositoryInterface $vacationRepositoryInterface;
    private UserRepositoryInterface $userRepositoryInterface;
    private CityHrRepositoryInterface $cityHrRepositoryInterface;
    private EmployeesAndPmRepositoryInterface $employeesAndPmRepositoryInterface;

    public function __construct(
        VacationRequestRepositoryInterface $vacationRequestRepositoryInterface,
        VacationRepositoryInterface $vacationRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface,
        CityHrRepositoryInterface $cityHrRepositoryInterface,
        EmployeesAndPmRepositoryInterface $employeesAndPmRepositoryInterface
    ) {
        $this->vacationRequestRepositoryInterface = $vacationRequestRepositoryInterface;
        $this->vacationRepositoryInterface = $vacationRepositoryInterface;
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->cityHrRepositoryInterface = $cityHrRepositoryInterface;
        $this->employeesAndPmRepositoryInterface = $employeesAndPmRepositoryInterface;
    }

    public function createVacationRequest(
        int $userId,
        Carbon $startDate,
        Carbon $endDate,
        int $numberOfDays,
        string $type
    ): VacationRequestDTO {
        $vacationRequestDTO = $this->vacationRequestRepositoryInterface->createVacationRequest(
            $userId,
            $startDate,
            $endDate,
            $numberOfDays,
            $type
        );

        event(new BypassVacationRequestCreatedEvent($vacationRequestDTO->getId(), $vacationRequestDTO->getUser()));

        if ($this->userRepositoryInterface->hasRole($vacationRequestDTO->getUser()->getId(), 'Employee')) {
            event(new CreateVacationRequestEvent($vacationRequestDTO));
        }

        return $vacationRequestDTO;
    }

    public function getVacationRequest(int $vacationRequestId): VacationRequestDTO
    {
        return $this->vacationRequestRepositoryInterface->getVacationRequest($vacationRequestId);
    }

    public function updateVacationRequest(
        int $userId,
        int $vacationRequestId,
        Carbon $startDate,
        Carbon $endDate,
        int $numberOfDays,
        string $type
    ): VacationRequestDTO {

        $vacationRequestDTO = $this->vacationRequestRepositoryInterface->updateVacationRequest(
            $vacationRequestId,
            $startDate,
            $endDate,
            $numberOfDays,
            $type
        );

        event(new EditVacationRequestEvent($vacationRequestDTO, $userId));

        return $vacationRequestDTO;
    }

    public function getVacationRequestsByUserId(int $userId): array
    {
        return $this->vacationRequestRepositoryInterface->getVacationRequestsByUserId($userId);
    }

    public function getEmployeesVacationRequests(int $userId): array
    {
        $cityIDs = $this->cityHrRepositoryInterface->getCitiesAssignedToHr($userId);
        $usersFromCity = $this->userRepositoryInterface->getUsersAssignedToHr($cityIDs);
        $employeeIDs = $this->employeesAndPmRepositoryInterface->getEmployeeIDs($userId);

        if ($this->userRepositoryInterface->hasRole($userId, 'HR')) {
            return $this->vacationRequestRepositoryInterface->getEmployeesVacationRequestsForHR($userId, $usersFromCity);
        }

        if ($this->userRepositoryInterface->hasRole($userId, 'PM')) {
            return $this->vacationRequestRepositoryInterface->getEmployeesVacationRequestsForPM($userId, $employeeIDs);
        }

        throw new \Exception('Access denied'); // TODO: use AccessDeniedException instead of generic one
    }

    public function denyVacationRequest(int $vacationRequestId): VacationRequestDTO
    {
        return $this->vacationRequestRepositoryInterface->denyVacationRequest($vacationRequestId);
    }

    public function approveVacationRequest(int $vacationRequestId): VacationRequestDTO
    {
        return $this->vacationRequestRepositoryInterface->approveVacationRequest($vacationRequestId);
    }

    public function cancelVacationRequest(int $vacationRequestId, int $userId): void
    {
        $vacationRequestDTO = $this->vacationRequestRepositoryInterface->cancelVacationRequest($vacationRequestId);

        if ($vacationRequestDTO->IsApproved() == true) {
            $this->vacationRepositoryInterface->cancelVacation($vacationRequestId);
        }

        event(new CancelVacationRequestEvent($vacationRequestDTO, $userId));
    }
}
