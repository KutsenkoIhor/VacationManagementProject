<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\CityDTO;
use App\Factories\CityFactory;
use App\Models\City;
use App\Repositories\Interfaces\CitiesRepositoryInterface;


class CitiesRepository implements CitiesRepositoryInterface
{
    private CityFactory $cityFactory;

    public  function __construct(CityFactory $cityFactory)
    {
        $this->cityFactory = $cityFactory;
    }

    public function all(): array
    {
        return $this->cityFactory->makeDTOFromModelCollection(City::all());
    }

    public function getById(int $id): CityDTO
    {
        return $this->cityFactory->makeDTOFromModel(City::findOrFail($id));
    }

    public function store(string $title, int $country_id): void
    {
        City::create([
            'title' => $title,
            'country_id' => $country_id,
        ]);
    }

    public function update(int $id, string $title, int $country_id): void
    {
        $city = City::findOrFail($id);
        $city->update([
            'title' => $title,
            'country_id' => $country_id,
        ]);
    }

    public function delete(int $id): void
    {
        City::findOrFail($id)->delete();
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

    public function searchCityByCountryId(int $countryId)
    {
        return City::where('country_id', $countryId)->first();
    }
}
