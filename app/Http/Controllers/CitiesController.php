<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AddCityRequest;
use App\Http\Requests\EditCityRequest;
use App\Services\Settings\CitiesService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;


class CitiesController extends Controller
{
    private CitiesService $citiesService;

    public function __construct(CitiesService $citiesService)

    {
        $this->citiesService = $citiesService;
    }

    public function index(): Factory|View|Application
    {

        $cities = $this->citiesService->all();

        return view('settings.cities.index', ['cities' => $cities]);
    }

    public function addCityForm(): Factory|View|Application
    {
        $countries = $this->citiesService->getCountries();

        return view('settings.cities.create', ['countries' => $countries]);
    }

    public function addCity(AddCityRequest $request): Redirector|RedirectResponse|Application
    {
        $this->citiesService->store($request);

        return redirect(route('cities.index'))->with('status', 'City added!');
    }

    public function editCityForm(int $id): Factory|View|Application
    {
        $city = $this->citiesService->getById($id);
        $countries = $this->citiesService->getCountries();

        return view('settings.cities.edit',[
            'city' => $city,
            'countries' => $countries
        ]);
    }

    public function editCity(int $id, EditCityRequest $request): Redirector|RedirectResponse|Application
    {
        $this->citiesService->update($id, $request);

        return redirect(route('cities.index'))->with('status', 'City edited!');
    }

    public function deleteCity(int $id): Redirector|RedirectResponse|Application
    {
        $this->citiesService->delete($id);

        return redirect(route('cities.index'))->with('status', 'City deleted!');
    }
}
