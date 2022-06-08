<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface CountryHolidayRepositoryInterface
{
    public function getCountryHolidayDates(int $userId): array;
}
