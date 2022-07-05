<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\VacationDaysPerYear;

interface VacationDaysPerYearRepositoryInterface
{
    public function updateOrCreate(int $userId, int $vacationsDays, int $personalDays, int $sickDays): void;
    public function getVacationDaysPerYear(int $userId): VacationDaysPerYear;
}
