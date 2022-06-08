<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\DTO\CityDTO;
use App\Models\City;

interface CitiesRepositoryInterface
{
    public function all(): array;
    public function getById(int $id): CityDTO;
    public function add($request): void;
    public function update(int $id, $request): void;
    public function delete(int $id): void;
    public function searchByCountryIdAndCity(int $countryID, string $city): City;
    public function searchCityById(int $cityId): string|null;
    public function searchIdByCity(string $city): int|null;
}
