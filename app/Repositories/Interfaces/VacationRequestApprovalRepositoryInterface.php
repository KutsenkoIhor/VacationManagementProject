<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\DTO\VacationRequestApprovalDTO;

interface VacationRequestApprovalRepositoryInterface
{
    public function createVacationRequestApproval(
        int $vacationRequestId,
        int $userId,
        int $isApproved
    ): void;
    public function getVacationRequestToApproveByRole(int $vacationRequestId, string $role): ?VacationRequestApprovalDTO;
}
