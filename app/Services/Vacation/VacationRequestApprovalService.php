<?php

declare(strict_types = 1);

namespace App\Services\Vacation;

use App\Events\ApproveVacationRequestEvent;
use App\Events\CreateVacationRequestApprovalEvent;
use App\Events\DenyVacationRequestEvent;
use App\Repositories\Interfaces\VacationRequestApprovalRepositoryInterface;

class VacationRequestApprovalService
{
    private VacationRequestApprovalRepositoryInterface $repository;

    public function __construct(VacationRequestApprovalRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function createVacationRequestApproval(int $vacationRequestId, int $userId, int $isApproved): void
    {
        $this->repository->createVacationRequestApproval(
            $vacationRequestId,
            $userId,
            $isApproved
        );

        event(new CreateVacationRequestApprovalEvent($vacationRequestId));
    }

    public function approveVacationRequest(int $vacationRequestId): void
    {
        $approvalRoles = config('approval_rule.approval_rule');

        $approveCount = 0;
        $denyCount = 0;
        foreach ($approvalRoles as $role) {
            $vacationRequestApproval = $this->repository->getVacationRequestToApproveByRole($vacationRequestId, $role);

            if (!$vacationRequestApproval) {
                continue;
            }

            $vacationRequestApproval->isApproved() ? $approveCount++ : $denyCount++;
        }

        if ($denyCount > 0) {
            event(new DenyVacationRequestEvent($vacationRequestId));

            return;
        }

        if ($approveCount == 1) {
            event(new ApproveVacationRequestEvent($vacationRequestId));
        }

        // do nothing. We should wait for other approval
    }
}
