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

    public function getVacationRequestsByUserId(int $userId): array
    {
        return $this->vacationRequestRepository->getVacationRequestsByUserId($userId);
    }

    public function getVacationRequestsForApproval(int $userId): array
    {
        return $this->vacationRequestRepository->getVacationRequestsForApproval($userId);
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
