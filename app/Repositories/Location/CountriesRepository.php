<?php

declare(strict_types=1);

namespace App\Repositories\Location;

use App\Models\Country;
use App\Models\City;
use App\Repositories\Interfaces\CountriesRepositoryInterface;


class CountriesRepository implements CountriesRepositoryInterface
{
    public function all()
    {
        return Country::all();
    }

    public function getById($id)
    {
        return Country::findOrFail($id);
    }

    public function add($request)
    {
        Country::create($request->all());
    }

    public function update($id, $request)
    {
        $country = Country::findOrFail($id);
        $country->update($request->all());
    }

    public function delete($id)
    {
        if (City::where('country_id', $id)->first()){
            return false;
        }

        Country::findOrFail($id)->delete();
    }

}
