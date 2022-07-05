<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\VacationDaysPerYear;
use App\Repositories\Interfaces\VacationDaysPerYearRepositoryInterface;

class VacationDaysPerYearRepository implements VacationDaysPerYearRepositoryInterface
{
    /**
     * @param int $userId
     * @param int $vacationsDays
     * @param int $personalDays
     * @param int $sickDays
     * @return void
     */
    public function updateOrCreate(int $userId, int $vacationsDays, int $personalDays, int $sickDays): void
    {
        VacationDaysPerYear::updateOrCreate(
            ['user_id' => $userId,],
            ['vacations' => $vacationsDays, 'personal_days' => $personalDays, 'sick_days' => $sickDays]
        );
    }

    public function getVacationDaysPerYear(int $userId): VacationDaysPerYear
    {
       return VacationDaysPerYear::where('user_id', $userId)->firstOrFail();
    }

}
