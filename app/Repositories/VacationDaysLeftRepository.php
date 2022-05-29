<?php

namespace App\Repositories;

use App\Models\VacationDaysLeft;
use App\Repositories\Interfaces\VacationDaysLeftInterface;

class VacationDaysLeftRepository implements VacationDaysLeftInterface
{
    public function create(int $userId, int $vacationsDays, int $personalDays, int $sickDays): void
    {
        VacationDaysLeft::create([
            'user_id' => $userId,
            'vacations' => $vacationsDays,
            'personal_days' => $personalDays,
            'sick_days' => $sickDays,
        ]);
    }
}
