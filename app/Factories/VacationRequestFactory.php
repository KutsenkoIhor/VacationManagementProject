<?php

declare(strict_types=1);

namespace App\Factories;

use App\DTO\VacationRequestDTO;
use App\Models\User;
use App\Models\VacationRequest;
use Illuminate\Database\Eloquent\Collection;

class VacationRequestFactory
{
    private UserFactory $user;

    public function __construct(UserFactory $user)
    {
        $this->user = $user;
    }

    public function makeDTOFromModel(VacationRequest $vacationRequest): VacationRequestDTO
    {
        return new VacationRequestDTO(
            $vacationRequest->id,
            $vacationRequest->start_date,
            $vacationRequest->end_date,
            $vacationRequest->number_of_days,
            $vacationRequest->type,
            $vacationRequest->is_approved,
            $vacationRequest->created_at,
            $vacationRequest->updated_at,
            $this->user->makeDTOFromModel($vacationRequest->user)
        );
    }

    public function makeDTOFromModelCollection(Collection $vacationRequests): array
    {
        $vacationRequestDTOs = [];

        foreach ($vacationRequests as $vacationRequest) {
            $vacationRequestDTOs[] = $this->makeDTOFromModel($vacationRequest);
        }

        return $vacationRequestDTOs;
    }
}
