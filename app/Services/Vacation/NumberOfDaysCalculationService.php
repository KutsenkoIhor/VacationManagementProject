<?php

declare(strict_types=1);


namespace App\Services\Vacation;

use App\DTO\VacationDaysNumberDTO;
use App\Repositories\CountryHolidayRepository;
use App\Repositories\VacationRepository;
use Carbon\Carbon;

class NumberOfDaysCalculationService
{
    private CountryHolidayRepository $countryHolidayRepository;
    private VacationRepository $vacationRepository;

    public function __construct(
        CountryHolidayRepository $countryHolidayRepository,
        VacationRepository $vacationRepository
    ) {
        $this->countryHolidayRepository = $countryHolidayRepository;
        $this->vacationRepository = $vacationRepository;
    }

    public function getNumberOfVacationRequestDays(
        int $userId,
        Carbon $startDate,
        Carbon $endDate,
        Carbon $date
    ): VacationDaysNumberDTO {
        $countryHolidays = $this->countryHolidayRepository->getCountryHolidayDates($userId);
        $numberCurrentYear = $numberNextYear = $numberPreviousYear = 0;
        $nextYear = (clone $date)->addYear()->year;
        $previousYear = (clone $date)->subYear()->year;

        for ($i = $startDate; $i <= $endDate; $i->addDay()) {
            if ($i->isWeekend() || in_array($i->startOfDay(), $countryHolidays)) {
                continue;
            }

            if ($i->year === $date->year) {
                $numberCurrentYear++;
            } elseif ($i->year === $nextYear) {
                $numberNextYear++;
            } elseif ($i->year === $previousYear) {
                $numberPreviousYear++;
            } else {
                throw new \Exception('Invalid start date: ' . $i->format(DATE_W3C));
            }
        }

        return new VacationDaysNumberDTO(
            $numberCurrentYear + $numberNextYear,
            $numberCurrentYear,
            $numberNextYear,
            $numberPreviousYear
        );
    }

    public function getNumberOfWorkingDaysByUserIdPerMonth(
        int $userId
    ): int {
        //TODO: include to a list of all employees
        //TODO: filter for choosing a month

        $daysInMonth = Carbon::now()->daysInMonth;

        $numberOfVacationDays = $this->vacationRepository->getNumberOfVacationDaysByUserIdPerMonth($userId);

        $countryHolidays = $this->countryHolidayRepository->getCountryHolidayDates($userId);

        $numberOfDaysOff = 0;

        for ($i = Carbon::now()->startOfMonth(); $i <= Carbon::now()->endOfMonth(); $i->addDay()) {
            if ($i->isWeekend() || in_array($i->startOfDay(), $countryHolidays)) {
                $numberOfDaysOff++;
            }
        }

       return $daysInMonth - $numberOfVacationDays - $numberOfDaysOff;
    }
}
