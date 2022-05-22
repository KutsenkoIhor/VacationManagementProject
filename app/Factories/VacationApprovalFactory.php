<?php

declare(strict_types=1);

namespace App\Factories;

use App\DTO\VacationApprovalDTO;
use App\Models\VacationApproval;
use Illuminate\Database\Eloquent\Collection;

class VacationApprovalFactory
{
    private HomePageFactory $userDTOFactory;
    private VacationFactory $vacationDTOFactory;

    public function __construct(HomePageFactory $userDTOFactory, VacationFactory $vacationDTOFactory)
    {
        $this->userDTOFactory = $userDTOFactory;
        $this->vacationDTOFactory = $vacationDTOFactory;
    }

    public function makeDTOFromModel(VacationApproval $vacationApproval): VacationApprovalDTO
    {
        return new VacationApprovalDTO(
            $vacationApproval->id,
            $vacationApproval->vacation_id,
            $vacationApproval->user_id,
            $vacationApproval->status,
            $this->userDTOFactory->makeDTOFromModel($vacationApproval->user),
            $this->vacationDTOFactory->makeDTOFromModel($vacationApproval->vacation)
        );
    }

    public function makeDTOFromModelCollection(Collection $vacationApprovals): array
    {
        $vacationApprovalDTOs = [];

        foreach ($vacationApprovals as $vacationApproval) {
            $vacationApprovalDTOs[] = $this->makeDTOFromModel($vacationApproval);
        }

        return $vacationApprovalDTOs;
    }
}
