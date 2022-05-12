<?php

namespace App\Repositories;

use App\Interfaces\VacationDaysPerYearRepositoryInterface;
use App\Models\VacationDaysPerYear;

class VacationDaysPerYearRepository implements VacationDaysPerYearRepositoryInterface
{
    public function create(int $userId, int $vacationsDays, int $personalDays, int $sickDays): void
    {
        VacationDaysPerYear::create([
            'user_id' => $userId,
            'vacations' => $vacationsDays,
            'personal_days' => $personalDays,
            'sick_days' => $sickDays,
        ]);
    }

}
