<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;


use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

interface CountryRepositoryInterface
{
    public function all();
    public function getById($id);
    public function add($request);
    public function update(int $id, $request);
    public function delete($id);
    public function orderBy(string $colum): Collection;
    public function searchByCountry(string $country): Country;
    public function searchCountryById(int $countryId): string|null;
    public function searchIdByCountry(string $country): int|null;

}
