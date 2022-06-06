<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\City;
use App\Models\Country;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\ListEmployees\ListEmployeesCityRepositoryInterface;


class CityRepository implements CityRepositoryInterface, ListEmployeesCityRepositoryInterface
{
    public function all(): object
    {
        return City::all();
    }

    public function getById($id): object
    {
        return City::findOrFail($id);
    }

    public function add($request)
    {
        City::create($request->all());
    }

    public function update($id, $request)
    {
        $city = City::findOrFail($id);
        $city->update($request->all());
    }

    public function delete($id)
    {
        City::findOrFail($id)->delete();
    }

    public function getCountry(int $country_id): string
    {
        return Country::where('id', $country_id)->first()->title;
    }

    public function getCountries()
    {
        return Country::all();
    }

    public function searchByCountryIdAndCity(int $countryID, string $city): City
    {
         return City::where([
            ['title', $city],
            ['country_id', $countryID],
        ])->first();
    }

    public function searchCityById(int $cityId): string|null
    {
        return City::where('id', $cityId)->first()->title;
    }

    public function searchIdByCity(string $city): int|null
    {
        return City::where('title', $city)->first()->id;
    }
}
