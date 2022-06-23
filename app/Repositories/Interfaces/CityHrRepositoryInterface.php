<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\User;

interface CityHrRepositoryInterface
{
    public function getCitiesAssignedToHr(int $userId): array;
    public function getHrAssignedToUser(int $cityId): User;
}

