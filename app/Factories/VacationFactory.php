<?php

declare(strict_types=1);

namespace App\Factories;

use App\DTO\VacationDTO;
use App\Models\User;
use App\Models\Vacation;
use Illuminate\Database\Eloquent\Collection;

class VacationFactory
{
    private UserFactory $user;
    private VacationRequestFactory $vacationRequest;

    public function __construct(UserFactory $user, VacationRequestFactory $vacationRequest)
    {
        $this->user = $user;
        $this->vacationRequest = $vacationRequest;
    }

    public function makeDTOFromModel(Vacation $vacation): VacationDTO
    {
        return new VacationDTO(
            $vacation->id,
            $vacation->start_date,
            $vacation->end_date,
            $vacation->number_of_days,
            $vacation->type,
            $vacation->created_at,
            $vacation->updated_at,
            $this->user->makeDTOFromModel($vacation->user),
            $this->vacationRequest->makeDTOFromModel($vacation->vacation_request)
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
