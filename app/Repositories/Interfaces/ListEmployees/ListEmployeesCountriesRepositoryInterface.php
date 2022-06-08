<?php

namespace App\Repositories\Interfaces\ListEmployees;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

interface ListEmployeesCountriesRepositoryInterface
{
    public function all();
    public function allCollection(): Collection;
    public function orderBy(string $colum): Collection;
    public function searchCountryById(int $countryId): string|null;
    public function searchByCountry(string $country): Country;
    public function searchIdByCountry(string $country): int|null;
}
