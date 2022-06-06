<?php

declare(strict_types=1);

namespace App\Repositories\Location;

use App\DTO\CountryDTO;
use App\Factories\CountryFactory;
use App\Models\Country;
use App\Models\City;
use App\Repositories\Interfaces\CountriesRepositoryInterface;


class CountriesRepository implements CountriesRepositoryInterface
{
    private CountryFactory $countryFactory;

    public function __construct(CountryFactory $countryFactory)
    {
        $this->countryFactory = $countryFactory;
    }

    public function all()
    {
        return $this->countryFactory->makeDTOFromModelCollection(Country::all());
    }

    public function getById(int $id): CountryDTO
    {
        return $this->countryFactory->makeDTOFromModel(Country::findOrFail($id));
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
