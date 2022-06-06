<?php

namespace App\Repositories\Interfaces\ListEmployees;

use App\Models\City;

interface ListEmployeesCityRepositoryInterface
{
    public function searchByCountryIdAndCity(int $countryID, string $city): City;
    public function searchCityById(int $cityId): string|null;
    public function searchIdByCity(string $city): int|null;
}
