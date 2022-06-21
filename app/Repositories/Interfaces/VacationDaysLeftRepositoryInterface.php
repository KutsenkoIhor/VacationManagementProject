<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface VacationDaysLeftRepositoryInterface
{
    public function create(int $userId, int $vacationsDays, int $personalDays, int $sickDays): void;
}
