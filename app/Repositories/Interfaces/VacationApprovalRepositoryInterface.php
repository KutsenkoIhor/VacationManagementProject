<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\DTO\VacationApprovalDTO;

interface VacationApprovalRepositoryInterface
{
    public function createVacationApproval(int $vacationId, int $userId, int $numberOfDays, string $status): VacationApprovalDTO;
    public function getVacationApprovalByRole(int $vacationId, string $role): ?VacationApprovalDTO;
}
