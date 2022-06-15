<?php

declare(strict_types=1);


namespace App\Services\Vacation;

use App\DTO\VacationRequestDTO;
use App\Events\VacationRequestCreatedEvent;
use App\Repositories\Interfaces\VacationRequestRepositoryInterface;
use Carbon\Carbon;

class VacationRequestService
{
    private VacationRequestRepositoryInterface $vacationRequestRepository;

    public function __construct(VacationRequestRepositoryInterface $vacationRequestRepository)
    {
        $this->vacationRequestRepository = $vacationRequestRepository;
    }

    public function createVacationRequest(
        int $userId,
        Carbon $startDate,
        Carbon $endDate,
        int $numberOfDays,
        string $type
    ): VacationRequestDTO {
        $vacationRequestDTO = $this->vacationRequestRepository->createVacationRequest(
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
        return $this->vacationRequestRepository->getVacationRequest($vacationRequestId);
    }

    public function updateVacationRequest(
        int $vacationRequestId,
        Carbon $startDate,
        Carbon $endDate,
        string $type
    ): VacationRequestDTO {

        return $this->vacationRequestRepository->updateVacationRequest(
            $vacationRequestId,
            $startDate,
            $endDate,
            $type
        );
    }

    public function getVacationRequestsByUserId(int $userId): array
    {
        return $this->vacationRequestRepository->getVacationRequestsByUserId($userId);
    }

    public function getEmployeesVacationRequests(int $userId): array
    {
        return $this->vacationRequestRepository->getEmployeesVacationRequests($userId);
    }

    public function denyVacationRequest(int $vacationRequestId): void
    {
        $this->vacationRequestRepository->denyVacationRequest($vacationRequestId);
    }

    public function approveVacationRequest(int $vacationRequestId): void
    {
        $this->vacationRequestRepository->approveVacationRequest($vacationRequestId);
    }

    public function cancelVacationRequest(int $vacationRequestId): void
    {
        $this->vacationRequestRepository->cancelVacationRequest($vacationRequestId);
    }
}
