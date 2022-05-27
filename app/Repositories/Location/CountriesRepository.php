<?php

declare(strict_types=1);

namespace App\Repositories\Location;

use App\Models\Country;
use App\Models\City;
use App\Repositories\Interfaces\CountriesRepositoryInterface;


class CountriesRepository implements CountriesRepositoryInterface
{
    public function all(): object
    {
        return Country::paginate(20);
    }

    public function getById(int $id): object
    {
        return Country::findOrFail($id);
    }

    public function getCountryTitle(int $country_id): string
    {
        return Country::where('id', $country_id)->first()->title;
    }

    public function add($request): void
    {
        Country::create($request->all());
    }

    public function update(int $id, $request): void
    {
        $country = Country::findOrFail($id);
        $country->update($request->all());
    }

    public function delete(int $id)
    {
        if (City::where('country_id', $id)->first()){
            return false;
        }

        Country::findOrFail($id)->delete();
    }

}
