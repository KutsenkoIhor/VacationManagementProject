<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface CityHrRepositoryInterface
{
    public function getCitiesAssignedToHr(int $userId): array;
}

