<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\DTO\VacationRequestDTO;
use Carbon\Carbon;

interface VacationRequestRepositoryInterface
{
    public function createVacationRequest(
        int $userId,
        Carbon $startDate,
        Carbon $endDate,
        int $numberOfDays,
        string $type
    ): VacationRequestDTO;
    public function getVacationRequestsByUserId(int $userId): array;
    public function getVacationRequestsForApproval(int $userId): array;
    public function denyVacationRequest(int $vacationRequestId): void;
    public function approveVacationRequest(int $vacationRequestId): void;
    public function cancelVacationRequest(int $vacationRequestId);
}

