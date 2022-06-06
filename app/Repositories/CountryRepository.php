<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\City;
use App\Models\Country;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\ListEmployees\ListEmployeesCountryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class CountryRepository implements CountryRepositoryInterface, ListEmployeesCountryRepositoryInterface
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

    /**
     * @param string $country
     * @return Country
     */
    public function searchByCountry(string $country): Country
    {
        return Country::where('title', $country)->first();
    }

    /**
     * @param int $countryId
     * @return string|null
     */
    public function searchCountryById(int $countryId): string|null
    {
        return Country::where('id', $countryId)->first()->title;
    }

    /**
     * @param string $country
     * @return int|null
     */
    public function searchIdByCountry(string $country): int|null
    {
        return Country::where('title', $country)->first()->id;
    }
}
