<?php

namespace App\Interfaces;

interface VacationDaysLeftInterface
{
    public function create(int $userId, int $vacationsDays, int $personalDays, int $sickDays): void;
}
