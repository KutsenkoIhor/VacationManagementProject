<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use Carbon\Carbon;

interface VacationRepositoryInterface
{
    public function createVacation(int $vacationRequestId): void;
    public function getUpcomingVacations(Carbon $startDate, Carbon $endDate): array;
}
