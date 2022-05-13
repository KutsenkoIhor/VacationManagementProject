<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\DTO\Vacation\VacationDTO;
use Carbon\Carbon;

interface VacationRepositoryInterface
{
    public function createVacation(
        int $userId,
        Carbon $startDate,
        Carbon $endDate,
        int $numberOfDays,
        string $type
    ): VacationDTO;
    public function getVacations(): array;
    public function getVacation(int $id): VacationDTO;
    public function getVacationsByUserId(int $id): array;
    public function getUpcomingVacations(Carbon $startDate, Carbon $endDate): array;
    public function getVacationsWithStatusNew(): array;
    public function changeStatus(int $id, string $status): VacationDTO;
    public function updateVacation(
        int $id,
        Carbon $startDate,
        Carbon $endDate,
        int $numberOfDays,
        string $type
    ): VacationDTO;
    public function deleteVacation(int $id);
}
