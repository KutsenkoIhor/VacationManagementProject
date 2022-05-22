<?php

declare(strict_types=1);

namespace App\Repositories\Vacation;

use App\DTO\VacationApprovalDTO;
use App\Factories\VacationApprovalFactory;
use App\Models\VacationApproval;
use App\Repositories\Interfaces\VacationApprovalRepositoryInterface;

class VacationApprovalRepository implements VacationApprovalRepositoryInterface
{
    private VacationApprovalFactory $vacationApprovalFactory;

    public function __construct(VacationApprovalFactory $vacationApprovalFactory)
    {
        $this->vacationApprovalFactory = $vacationApprovalFactory;
    }

    public function createVacationApproval(int $vacationId, int $userId, int $numberOfDays, string $status): VacationApprovalDTO
    {
        $vacationApproval = new VacationApproval();

        $vacationApproval->vacation_id = $vacationId;
        $vacationApproval->user_id = $userId;
        $vacationApproval->status = $status;

        $vacationApproval->save();

        return $this->vacationApprovalFactory->makeDTOFromModel($vacationApproval);
    }

    public function getVacationApprovalByRole(int $vacationId, string $role): ?VacationApprovalDTO
    {
        $approvals = VacationApproval::where('vacation_id', $vacationId)
            ->with('user')
            ->get();

        foreach ($approvals as $approval) {
            if ($approval->user->hasRole($role)) {
                return $this->vacationApprovalFactory->makeDTOFromModel($approval);
            }
        }

        return null;
    }

}
