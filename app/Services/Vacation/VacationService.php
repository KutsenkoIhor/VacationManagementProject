<?php

declare(strict_types=1);

namespace App\Services\Vacation;

use App\DTO\Vacation\VacationDTO;
use App\Interfaces\VacationRepositoryInterface;
use Carbon\Carbon;

class VacationService
{
    private VacationRepositoryInterface $vacationRepository;

    public function __construct(VacationRepositoryInterface $vacationRepository)
    {
        $this->vacationRepository = $vacationRepository;
    }

    public function createVacation(
        int $userId,
        Carbon $startDate,
        Carbon $endDate,
        string $type
    ) : VacationDTO {
        $numberOfDays = 4; //TODO create NumberOfDaysCalculationService [weekends, holidays etc.]

        return $this->vacationRepository->createVacation(
            $userId,
            $startDate,
            $endDate,
            $numberOfDays,
            $type
        );
    }
}
