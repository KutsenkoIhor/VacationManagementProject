<?php

namespace App\Interfaces;

interface VacationDaysPerYearRepositoryInterface
{
    public function create(int $userId, int $vacationsDays, int $personalDays, int $sickDays): void;
}
