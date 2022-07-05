<?php

declare(strict_types=1);

namespace App\Services\Vacation;

use App\Models\Vacation;
use App\Repositories\Interfaces\VacationDaysPerYearRepositoryInterface;
use App\Repositories\Interfaces\VacationRepositoryInterface;
use Carbon\Carbon;

class VacationDaysLeftCalculationService
{
    private VacationRepositoryInterface $vacationRepositoryInterface;
    private VacationDaysPerYearRepositoryInterface $vacationDaysPerYearRepositoryInterface;
    private NumberOfDaysCalculationService $service;

    public function __construct(
        VacationRepositoryInterface $vacationRepositoryInterface,
        NumberOfDaysCalculationService $service,
        VacationDaysPerYearRepositoryInterface $vacationDaysPerYearRepositoryInterface
    ) {
        $this->vacationRepositoryInterface = $vacationRepositoryInterface;
        $this->service = $service;
        $this->vacationDaysPerYearRepositoryInterface = $vacationDaysPerYearRepositoryInterface;
    }

    public function getVacationDaysLeftFilteredByType(int $userId, Carbon $date): array
    {
        $vacationDaysPerYear = $this->vacationDaysPerYearRepositoryInterface->getVacationDaysPerYear($userId);

        return [
            Vacation::TYPE_VACATIONS     => $this->calculateVacationDaysLeft($userId, $date, Vacation::TYPE_VACATIONS, $vacationDaysPerYear->vacations),
            Vacation::TYPE_PERSONAL_DAYS => $this->calculateVacationDaysLeft($userId, $date, Vacation::TYPE_PERSONAL_DAYS, $vacationDaysPerYear->personal_days),
            Vacation::TYPE_SICK_DAYS     => $this->calculateVacationDaysLeft($userId, $date, Vacation::TYPE_SICK_DAYS, $vacationDaysPerYear->sick_days),
        ];
    }

    private function calculateVacationDaysLeft(int $userId, Carbon $date, string $type, int $default): int
    {
        $vacationsPerYear = $this->vacationRepositoryInterface->getVacationsPerYear($userId, $date, $type);

        $numberOfDaysSum = 0;

        foreach ($vacationsPerYear as $vacationPerYear) {
            $vacationDaysNumberDTO = $this->service->getNumberOfVacationRequestDays(
                $vacationPerYear['user_id'],
                Carbon::parse($vacationPerYear['start_date']),
                Carbon::parse($vacationPerYear['end_date']),
                clone $date
            );

            $numberOfDaysSum += $vacationDaysNumberDTO->getNumberOfDaysCurrentYear();

        }

        return $default - $numberOfDaysSum;
    }
}
