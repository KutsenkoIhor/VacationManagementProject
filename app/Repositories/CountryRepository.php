<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Factories\CountryFactory;
use App\Interfaces\CountryRepositoryInterface;
use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;


class CountryRepository implements CountryRepositoryInterface
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

    public function update(int $id, $request): void
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

    /**
     * @param string $colum
     * @return Collection
     */
    public function orderBy(string $colum): Collection
    {
        return Country::orderBy($colum)->get();
    }

    public function searchByCountry(string $country): Country
    {
        return Country::where('title', $country)->first();
    }
}
