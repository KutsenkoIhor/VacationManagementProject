<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface CountryHolidayRepositoryInterface
{
    public function all();
    public function getById(int $id);
    public function store(string $title, int $country_id, $date);
    public function update(int $id, string $title, int $country_id, $date);
    public function delete(int $id);
    public function getCountryHolidayDates(int $userId): array;
}
