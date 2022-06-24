<?php

declare(strict_types=1);

namespace App\Services\Settings;

use App\Repositories\Interfaces\CitiesRepositoryInterface;
use App\Repositories\Interfaces\CountriesRepositoryInterface;
use App\Http\Requests\AddCityRequest;
use App\Http\Requests\EditCityRequest;

class CitiesService
{
    private CountriesRepositoryInterface $countriesRepository;
    private CitiesRepositoryInterface $citiesRepository;

    public function __construct(CountriesRepositoryInterface $countriesRepository, CitiesRepositoryInterface $citiesRepository)
    {
        $this->countriesRepository = $countriesRepository;
        $this->citiesRepository = $citiesRepository;
    }

    public function all(): array
    {
        return $this->citiesRepository->all();
    }

    public function store(AddCityRequest $request): void
    {
        $title = $request->title;
        $country_id = (int)$request->country_id;

        $this->citiesRepository->store($title, $country_id);
    }

    public function getById(int $id): object
    {
        return $this->citiesRepository->getById($id);
    }

    public function update(int $id, EditCityRequest $request): void
    {
        $title = $request->title;
        $country_id = (int) $request->country_id;

        $this->citiesRepository->update($id, $title, $country_id);
    }

    public function delete(int $id): void
    {
        $this->citiesRepository->delete($id);
    }

    public function getCountries(): array
    {
        return $this->countriesRepository->all();
    }
}
