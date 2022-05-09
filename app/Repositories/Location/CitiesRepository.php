<?php

declare(strict_types=1);

namespace App\Repositories\Location;

use App\Models\City;
use App\Models\Country;
use App\Repositories\Interfaces\CitiesRepositoryInterface;


class CitiesRepository implements CitiesRepositoryInterface
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
}
