<?php

declare(strict_types = 1);

namespace App\Services\Vacation;

use App\Models\Vacation;
use App\Models\VacationApproval;
use App\Repositories\Interfaces\VacationApprovalRepositoryInterface;
use App\Repositories\Interfaces\VacationRepositoryInterface;

class VacationApprovalService
{
    private VacationApprovalRepositoryInterface $vacationApprovalRepository;
    private VacationRepositoryInterface $vacationRepository;

    public function __construct(
        VacationApprovalRepositoryInterface $vacationApprovalRepository,
        VacationRepositoryInterface $vacationRepository
    ) {
        $this->vacationApprovalRepository = $vacationApprovalRepository;
        $this->vacationRepository = $vacationRepository;
    }

    public function approveVacation(int $vacationId): void
    {
        $approvalRoles = config('approval_rule.approval_rule');

        $approveCount = 0;
        $denyCount = 0;
        foreach ($approvalRoles as $role) {
            $vacationApproval = $this->vacationApprovalRepository->getVacationApprovalByRole($vacationId, $role);

            if (!$vacationApproval) {
                continue;
            }

            $approveCount += (int) ($vacationApproval->getStatus() == VacationApproval::STATUS_APPROVED);
            $denyCount += (int) ($vacationApproval->getStatus() == VacationApproval::STATUS_DENIED);
        }

        if ($denyCount > 0) {
            $this->vacationRepository->updateVacationStatus($vacationId, Vacation::STATUS_DENIED);

            return;
        }

        if ($approveCount == 2) {
            $this->vacationRepository->updateVacationStatus($vacationId, Vacation::STATUS_APPROVED);
        }

        // do nothing. We should wait for other approval
    }
}
