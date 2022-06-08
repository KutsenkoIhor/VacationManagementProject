<?php

namespace App\Repositories\Interfaces;

interface VacationDaysPerYearRepositoryInterface
{
    public function updateOrCreate(int $userId, int $vacationsDays, int $personalDays, int $sickDays): void;
}
