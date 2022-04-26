<?php

declare(strict_types=1);

namespace App\Services\Vacation;

use App\DTO\Vacation\VacationDTO;
use App\Interfaces\VacationRepositoryInterface;
use App\Models\Vacation;
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

    public function getVacations(): array
    {
        return $this->vacationRepository->getVacations();
    }

    public function getVacation(int $id): VacationDTO
    {
        return $this->vacationRepository->getVacation($id);
    }

    public function getVacationsByUserId(int $id): array
    {
        return $this->vacationRepository->getVacationsByUserId($id);
    }

    public function updateVacation(
        int $id,
        int $userId,
        Carbon $startDate,
        Carbon $endDate,
        string $type
    ) : VacationDTO  {

        $numberOfDays = 4; //TODO create NumberOfDaysCalculationService [weekends, holidays etc.]

        return $this->vacationRepository->updateVacation(
            $id,
            $userId,
            $startDate,
            $endDate,
            $numberOfDays,
            $type
        );
    }

    public function deleteVacation(int $id)
    {
        return $this->vacationRepository->deleteVacation($id);
    }
}
