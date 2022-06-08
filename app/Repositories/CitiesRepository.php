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

    public function add($request): void
    {
        City::create($request->all());
    }

    public function update(int $id, $request): void
    {
        $city = City::findOrFail($id);
        $city->update($request->all());
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
}
