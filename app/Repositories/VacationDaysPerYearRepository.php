<?php

namespace App\Repositories;

use App\Models\VacationDaysPerYear;
use App\Repositories\Interfaces\VacationDaysPerYearRepositoryInterface;

class VacationDaysPerYearRepository implements VacationDaysPerYearRepositoryInterface
{
    public function updateOrCreate(int $userId, int $vacationsDays, int $personalDays, int $sickDays): void
    {
        VacationDaysPerYear::updateOrCreate(
            ['user_id' => $userId,],
            ['vacations' => $vacationsDays, 'personal_days' => $personalDays, 'sick_days' => $sickDays]
        );
    }

}
