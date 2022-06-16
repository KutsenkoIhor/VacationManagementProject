<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface VacationDaysPerYearRepositoryInterface
{
    public function updateOrCreate(int $userId, int $vacationsDays, int $personalDays, int $sickDays): void;
}
