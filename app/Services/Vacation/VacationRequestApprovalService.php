<?php

declare(strict_types = 1);

namespace App\Services\Vacation;

use App\Events\ApproveVacationRequestEvent;
use App\Events\CalculateVacationDaysLeftEvent;
use App\Events\CreateVacationRequestApprovalEvent;
use App\Events\DenyVacationRequestEvent;
use App\Repositories\Interfaces\VacationRequestApprovalRepositoryInterface;
use Illuminate\Support\Facades\Auth;

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

        event(new CreateVacationRequestApprovalEvent($vacationRequestId, $userId));
    }

    public function approveVacationRequest(int $vacationRequestId, int $userId): void
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
            event(new DenyVacationRequestEvent($vacationRequestId, $userId));

            return;
        }

        if ($approveCount == 2) {
            event(new ApproveVacationRequestEvent($vacationRequestId, $userId));
        }

        // do nothing. We should wait for other approval
    }
}
