<?php

declare(strict_types=1);

namespace App\Repositories\Vacation;

use App\Factories\VacationRequestApprovalFactory;
use App\Models\VacationRequestApproval;
use App\DTO\VacationRequestApprovalDTO;
use App\Repositories\Interfaces\VacationRequestApprovalRepositoryInterface;

class VacationRequestApprovalRepository implements VacationRequestApprovalRepositoryInterface
{
    private VacationRequestApprovalFactory $vacationRequestApprovalFactory;

    public function __construct(VacationRequestApprovalFactory $vacationRequestApprovalFactory)
    {
        $this->vacationRequestApprovalFactory = $vacationRequestApprovalFactory;
    }

    public function createVacationRequestApproval(
        int $vacationRequestId,
        int $userId,
        int $isApproved
    ): void {
        $vacationRequestApproval = new VacationRequestApproval();

        $vacationRequestApproval->user_id = $userId;
        $vacationRequestApproval->vacation_request_id = $vacationRequestId;
        $vacationRequestApproval->is_approved = $isApproved;

        $vacationRequestApproval->save();
    }

    public function getVacationRequestToApproveByRole(int $vacationRequestId, string $role): ?VacationRequestApprovalDTO
    {
        $approvals = VacationRequestApproval::where('vacation_request_id', $vacationRequestId)
            ->with('user')
            ->get();

        foreach ($approvals as $approval) {
            if ($approval->user->hasRole($role)) {
                return $this->vacationRequestApprovalFactory->makeDTOFromModel($approval);
            }
        }

        return null;
    }
}
