<?php

declare(strict_types=1);

namespace App\Interfaces;

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
}
