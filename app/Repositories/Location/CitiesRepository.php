<?php

declare(strict_types=1);

namespace App\Repositories\Location;

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
}
