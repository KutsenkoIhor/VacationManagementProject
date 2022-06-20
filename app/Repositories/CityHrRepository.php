<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\CityHr;
use App\Repositories\Interfaces\CityHrRepositoryInterface;

class CityHrRepository implements CityHrRepositoryInterface
{
    public function getCitiesAssignedToHr(int $userId): array
    {
        return CityHr::where('hr_id', $userId)
            ->pluck('city_id')
            ->all();
    }
}
