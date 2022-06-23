<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\CountryDTO;
use App\Factories\CountryFactory;
use App\Models\City;
use App\Models\Country;
use App\Repositories\Interfaces\CountriesRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


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

    public function allCollection(): Collection
    {
        return Country::all();
    }

    public function getById(int $id): CountryDTO
    {
        return $this->countryFactory->makeDTOFromModel(Country::findOrFail($id));
    }

    public function store(string $title): void
    {
        Country::create([
            'title' => $title,
        ]);
    }

    public function update(int $id, string $title): void
    {
        $country = Country::findOrFail($id);

        $country->update([
            'title' => $title,
        ]);
    }

    public function delete(int $id): void
    {
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
