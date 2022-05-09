<?php

declare(strict_types=1);

namespace App\Factories;

use App\DTO\Vacation\VacationDTO;
use App\Models\Vacation;
use Illuminate\Database\Eloquent\Collection;

class VacationFactory
{
    private HomePageFactory $userDTOFactory;

    public function __construct(HomePageFactory $userDTOFactory)
    {
        $this->userDTOFactory = $userDTOFactory;
    }

    public function makeDTOFromModel(Vacation $vacation): VacationDTO
    {
        return new VacationDTO(
            $vacation->id,
            $vacation->user_id,
            $vacation->start_date,
            $vacation->end_date,
            $vacation->type,
            $vacation->status,
            $this->userDTOFactory->makeDTOFromModel($vacation->user)
        );
    }

    public function makeDTOFromModelCollection(Collection $vacations): array
    {
        $vacationDTOs = [];

        foreach ($vacations as $vacation) {
            $vacationDTOs[] = $this->makeDTOFromModel($vacation);
        }

        return $vacationDTOs;
    }
}
