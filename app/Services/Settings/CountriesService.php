<?php

declare(strict_types=1);

namespace App\Services\Settings;

use App\Repositories\Interfaces\CitiesRepositoryInterface;
use App\Repositories\Interfaces\CountriesRepositoryInterface;
use App\Http\Requests\AddCountryRequest;
use App\Http\Requests\EditCountryRequest;

class CountriesService
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
        return $this->countriesRepository->all();
    }

    public function store(AddCountryRequest $request): void
    {
            $title = $request->title;

            $this->countriesRepository->store($title);
    }

    public function getById(int $id): object
    {
        return $this->countriesRepository->getById($id);
    }

    public function update(int $id, EditCountryRequest $request): void
    {
        $title = $request->title;

        $this->countriesRepository->update($id, $title);
    }

    public function delete(int $id): bool|null
    {
        if ($this->citiesRepository->searchCityByCountryId($id)){
            return false;
        }

        return $this->countriesRepository->delete($id);
    }
}
