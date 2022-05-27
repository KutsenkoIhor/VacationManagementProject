<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AddCityRequest;
use App\Http\Requests\EditCityRequest;
use App\Repositories\Interfaces\CitiesRepositoryInterface;
use App\Repositories\Interfaces\CountriesRepositoryInterface;

class CitiesController extends Controller
{
    private $citiesRepository;
    private $countriesRepository;

    public function __construct(CitiesRepositoryInterface $citiesRepository, CountriesRepositoryInterface $countriesRepository)
    {
        $this->citiesRepository = $citiesRepository;
        $this->countriesRepository = $countriesRepository;
    }

    public function index()
    {
        $cities = $this->citiesRepository->all();
        foreach ($cities as $city){
            $city->country = $this->countriesRepository->getCountryTitle((int) $city->country_id);
        }

        return view('settings.cities.index', ['cities' => $cities]);
    }

    public function addCityForm()
    {
        $countries = $this->countriesRepository->all();
        return view('settings.cities.create', ['countries' => $countries]);
    }

    public function addCity(AddCityRequest $request)
    {
        $this->citiesRepository->add($request);

        return redirect(route('cities.index'))->with('status', 'City added!');
    }

    public function editCityForm(int $id)
    {
        $city = $this->citiesRepository->getById((int) $id);
        $countries = $this->countriesRepository->all();

        return view('settings.cities.edit',[
            'city' => $city,
            'countries' => $countries
        ]);
    }

    public function editCity(int $id, EditCityRequest $request)
    {
        $this->citiesRepository->update((int) $id, $request);

        return redirect(route('cities.index'))->with('status', 'City edited!');
    }

    public function deleteCity(int $id)
    {
        $this->citiesRepository->delete((int) $id);

        return redirect(route('cities.index'))->with('status', 'City deleted!');
    }
}
