<?php

namespace App\Repositories\Interfaces\ListEmployees;

interface ListEmployeesVacationDaysPerYearRepositoryInterface
{
    public function updateOrCreate(int $userId, int $vacationsDays, int $personalDays, int $sickDays): void;
}
