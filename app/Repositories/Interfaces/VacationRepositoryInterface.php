<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\DTO\VacationDTO;
use Carbon\Carbon;

interface VacationRepositoryInterface
{
    public function createVacation(int $vacationRequestId): void;
    public function getUpcomingVacations(Carbon $startDate, Carbon $endDate): array;
    public function getNumberOfVacationDaysByUserIdPerMonth(int $userId): int;
    public function getVacationsPerYear(int $userId, Carbon $date, string $type): array;
    public function getVacationsByUserId(int $userId): array;
    public function cancelVacation(int $vacationRequestId): void;
}
