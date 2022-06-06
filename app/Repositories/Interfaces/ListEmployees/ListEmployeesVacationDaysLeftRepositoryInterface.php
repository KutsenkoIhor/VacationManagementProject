<?php

namespace App\Repositories\Interfaces\ListEmployees;

interface ListEmployeesVacationDaysLeftRepositoryInterface
{
    public function create(int $userId, int $vacationsDays, int $personalDays, int $sickDays): void;
}
