<?php

declare(strict_types=1);

namespace App\Services\Vacation;

use App\Models\Vacation;
use App\Models\VacationDaysPerYear;
use App\Repositories\Interfaces\VacationRepositoryInterface;
use Carbon\Carbon;

class VacationDaysLeftCalculationService
{
    private VacationRepositoryInterface $interface;
    private NumberOfDaysCalculationService $service;

    public function __construct(VacationRepositoryInterface $interface, NumberOfDaysCalculationService $service)
    {
        $this->interface = $interface;
        $this->service = $service;
    }

    public function getVacationDaysLeftFilteredByType(int $userId, Carbon $date): array
    {
        //TODO: move to VacationDaysPerYearRepository
        $vacationDaysPerYear = VacationDaysPerYear::where('user_id', $userId)->firstOrFail();

        return [
            Vacation::TYPE_VACATIONS     => $this->calculateVacationDaysLeft($userId, $date, Vacation::TYPE_VACATIONS, $vacationDaysPerYear->vacations),
            Vacation::TYPE_PERSONAL_DAYS => $this->calculateVacationDaysLeft($userId, $date, Vacation::TYPE_PERSONAL_DAYS, $vacationDaysPerYear->personal_days),
            Vacation::TYPE_SICK_DAYS     => $this->calculateVacationDaysLeft($userId, $date, Vacation::TYPE_SICK_DAYS, $vacationDaysPerYear->sick_days),
        ];
    }

    private function calculateVacationDaysLeft(int $userId, Carbon $date, string $type, int $default): int
    {
        $vacationsPerYear = $this->interface->getVacationsPerYear($userId, $date, $type);

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

        return  $default - $numberOfDaysSum;
    }
}
