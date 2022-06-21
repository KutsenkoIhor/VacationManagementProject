<?php

declare(strict_types=1);

namespace App\Services\Vacation;

use App\DTO\VacationRequestDTO;
use App\Events\VacationRequestCreatedEvent;
use App\Repositories\Interfaces\CityHrRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\VacationRequestRepositoryInterface;
use Carbon\Carbon;

class VacationRequestService
{
    private VacationRequestRepositoryInterface $vacationRepositoryInterface;
    private UserRepositoryInterface $userRepositoryInterface;
    private CityHrRepositoryInterface $cityHrRepositoryInterface;

    public function __construct(
        VacationRequestRepositoryInterface $vacationRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface,
        CityHrRepositoryInterface $cityHrRepositoryInterface
    )
    {
        $this->vacationRepositoryInterface = $vacationRepositoryInterface;
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->cityHrRepositoryInterface = $cityHrRepositoryInterface;
    }

    public function createVacationRequest(
        int $userId,
        Carbon $startDate,
        Carbon $endDate,
        int $numberOfDays,
        string $type
    ): VacationRequestDTO {
        $vacationRequestDTO = $this->vacationRepositoryInterface->createVacationRequest(
            $userId,
            $startDate,
            $endDate,
            $numberOfDays,
            $type
        );

        event(new VacationRequestCreatedEvent($vacationRequestDTO->getId(), $vacationRequestDTO->getUser()));

        return $vacationRequestDTO;
    }

    public function getVacationRequest(int $vacationRequestId): VacationRequestDTO
    {
        return $this->vacationRepositoryInterface->getVacationRequest($vacationRequestId);
    }

    public function updateVacationRequest(
        int $vacationRequestId,
        Carbon $startDate,
        Carbon $endDate,
        string $type
    ): VacationRequestDTO {

        return $this->vacationRepositoryInterface->updateVacationRequest(
            $vacationRequestId,
            $startDate,
            $endDate,
            $type
        );
    }

    public function getVacationRequestsByUserId(int $userId): array
    {
        return $this->vacationRepositoryInterface->getVacationRequestsByUserId($userId);
    }

    public function getEmployeesVacationRequests(int $userId): array
    {
        $cityIDs = $this->cityHrRepositoryInterface->getCitiesAssignedToHr($userId);

        $usersFromCity = $this->userRepositoryInterface->getUsersAssignedToHr($cityIDs);

        if ($this->userRepositoryInterface->hasRole($userId, 'HR')) {
            return $this->vacationRepositoryInterface->getEmployeesVacationRequestsForHR($userId, $usersFromCity);
        }

        if ($this->userRepositoryInterface->hasRole($userId, 'PM')) {
            return $this->vacationRepositoryInterface->getEmployeesVacationRequestsForPM($userId);
        }

        throw new \Exception('Access denied'); //TODO: use AccessDeniedException instead of generic one
    }

    public function denyVacationRequest(int $vacationRequestId): void
    {
        $this->vacationRepositoryInterface->denyVacationRequest($vacationRequestId);
    }

    public function approveVacationRequest(int $vacationRequestId): VacationRequestDTO
    {
        return $this->vacationRepositoryInterface->approveVacationRequest($vacationRequestId);
    }

    public function cancelVacationRequest(int $vacationRequestId): void
    {
        $this->vacationRepositoryInterface->cancelVacationRequest($vacationRequestId);
    }
}
