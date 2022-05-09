<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AddCityRequest;
use App\Http\Requests\EditCityRequest;
use App\Repositories\Interfaces\CitiesRepositoryInterface;

class CitiesController extends Controller
{
    private $citiesRepository;

    public function __construct(CitiesRepositoryInterface $citiesRepository)
    {
        $this->citiesRepository = $citiesRepository;
    }

    public function index()
    {
        $cities = $this->citiesRepository->all();
        foreach ($cities as $city){
            $city->country = $this->citiesRepository->getCountry($city->country_id);
        }

        return view('location.cities.index', ['cities' => $cities]);
    }

    public function addCityForm()
    {
        $countries = $this->citiesRepository->getCountries();
        return view('location.cities.create', ['countries' => $countries]);
    }

    public function addCity(AddCityRequest $request)
    {
        $this->citiesRepository->add($request);

        return redirect(route('cities.index'))->with('status', 'City added!');
    }

    public function editCityForm($id)
    {
        $city = $this->citiesRepository->getById($id);
        $countries = $this->citiesRepository->getCountries();

        return view('location.cities.edit',[
            'city' => $city,
            'countries' => $countries
        ]);
    }

    public function editCity($id, EditCityRequest $request)
    {
        $this->citiesRepository->update($id, $request);

        return redirect(route('cities.index'))->with('status', 'City edited!');
    }

    public function deleteCity($id)
    {
        $this->citiesRepository->delete($id);

        return redirect(route('cities.index'))->with('status', 'City deleted!');
    }
}
