<?php

namespace App\Repositories\Interfaces;

interface VacationDaysLeftRepositoryInterface
{
    public function create(int $userId, int $vacationsDays, int $personalDays, int $sickDays): void;
}
