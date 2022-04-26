<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTO\Vacation\VacationDTO;
use App\Models\Vacation;
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
    public function updateVacation(
        int $id,
        int $userId,
        Carbon $startDate,
        Carbon $endDate,
        int $numberOfDays,
        string $type
    ): VacationDTO;
    public function deleteVacation(int $id);
}
