<?php

namespace App\Repositories;

use App\Models\VacationDaysPerYear;
use App\Repositories\Interfaces\ListEmployees\ListEmployeesVacationDaysPerYearRepositoryInterface;

class VacationDaysPerYearRepository implements ListEmployeesVacationDaysPerYearRepositoryInterface
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

}
