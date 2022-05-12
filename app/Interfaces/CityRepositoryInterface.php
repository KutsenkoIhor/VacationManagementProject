<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\City;

interface CityRepositoryInterface
{
    public function all();
    public function getById(int $id);
    public function add($request);
    public function update(int $id, $request);
    public function delete($id);
    public function getCountry(int $country_id);
    public function getCountries();
    public function searchByCountryIdAndCity(int $countryID, string $city): City;
}
