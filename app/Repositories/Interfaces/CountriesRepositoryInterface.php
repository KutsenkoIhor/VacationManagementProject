<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\DTO\CountryDTO;
use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

interface CountriesRepositoryInterface
{
    public function all();
    public function allCollection(): Collection;
    public function getById(int $id): CountryDTO;
    public function add($request): void;
    public function update(int $id, $request): void;
    public function delete(int $id);
    public function orderBy(string $colum): Collection;
    public function searchByCountry(string $country): Country;
    public function searchCountryById(int $countryId): string|null;
    public function searchIdByCountry(string $country): int|null;
}
