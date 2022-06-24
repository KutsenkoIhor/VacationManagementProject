<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Interfaces\CountryHolidayRepositoryInterface;
use App\Repositories\Interfaces\CountriesRepositoryInterface;
use App\Http\Requests\AddPublicHolidayRequest;
use App\Http\Requests\EditPublicHolidayRequest;

class PublicHolidaysService
{
    private CountryHolidayRepositoryInterface $countryHolidayRepository;
    private CountriesRepositoryInterface $countriesRepository;

    public function __construct(CountryHolidayRepositoryInterface $countryHolidayRepository, CountriesRepositoryInterface $countriesRepository)
    {
        $this->countryHolidayRepository = $countryHolidayRepository;
        $this->countriesRepository = $countriesRepository;
    }

    public function all(): array
    {
        return $this->countryHolidayRepository->all();
    }

    public function store(AddPublicHolidayRequest $request): void
    {
        foreach($request->countries as $country_id) {
            $title = $request->title;
            $country = $country_id;
            $date = $request->date;

            $this->countryHolidayRepository->store($title, $country, $date);
        }
    }

    public function getById(int $id)
    {
        return $this->countryHolidayRepository->getById($id);
    }

    public function update(int $id, EditPublicHolidayRequest $request): void
    {
        $title = $request->title;
        $country = $request->country_id;
        $date = $request->date;

        $this->countryHolidayRepository->update($id, $title, $country, $date);
    }

    public function delete(int $id): void
    {
        $this->countryHolidayRepository->delete($id);
    }

    public function getCountries()
    {
        return $this->countriesRepository->all();
    }
}
