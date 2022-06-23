<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\VacationDaysLeft;
use App\Repositories\Interfaces\VacationDaysLeftRepositoryInterface;

class VacationDaysLeftRepository implements VacationDaysLeftRepositoryInterface
{
    /**
     * @param int $userId
     * @param int $vacationsDays
     * @param int $personalDays
     * @param int $sickDays
     * @return void
     */
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
