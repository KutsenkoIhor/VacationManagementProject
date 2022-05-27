<?php

declare(strict_types=1);

namespace App\Repositories\Location;

use App\Models\City;
use App\Repositories\Interfaces\CitiesRepositoryInterface;


class CitiesRepository implements CitiesRepositoryInterface
{
    public function all(): object
    {
        return City::all();
    }

    public function getById(int $id): object
    {
        return City::findOrFail($id);
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
