<?php

declare(strict_types=1);

namespace App\Factories;

use App\DTO\VacationRequestApprovalDTO;
use App\Models\VacationRequestApproval;
use Illuminate\Database\Eloquent\Collection;

class VacationRequestApprovalFactory
{
    private HomePageFactory $user;
    private VacationRequestFactory $vacationRequest;

    public function __construct(HomePageFactory $user, VacationRequestFactory $vacationRequest)
    {
        $this->user = $user;
        $this->vacationRequest = $vacationRequest;
    }

    public function makeDTOFromModel(VacationRequestApproval $vacationRequestApproval): VacationRequestApprovalDTO
    {
        return new VacationRequestApprovalDTO(
            $vacationRequestApproval->id,
            $vacationRequestApproval->is_approved,
            $vacationRequestApproval->created_at,
            $vacationRequestApproval->updated_at,
            $this->user->makeDTOFromModel($vacationRequestApproval->user),
            $this->vacationRequest->makeDTOFromModel($vacationRequestApproval->vacation_request)
        );
    }

    public function makeDTOFromModelCollection(Collection $vacationRequestApprovals): array
    {
        $vacationRequestApprovalsDTOs = [];

        foreach ($vacationRequestApprovals as $vacationRequestApproval) {
            $vacationRequestApprovalsDTOs[] = $this->makeDTOFromModel($vacationRequestApproval);
        }

        return $vacationRequestApprovalsDTOs;
    }
}
