<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AddCountryRequest;
use App\Http\Requests\EditCountryRequest;
use App\Services\Settings\CountriesService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class CountriesController extends Controller
{
    private CountriesService $countriesService;

    public function __construct(CountriesService $countriesService)
    {
        $this->countriesService = $countriesService;
    }

    public function index(): Factory|View|Application
    {
        $countries = $this->countriesService->all();

        return view('settings.countries.index', ['countries' => $countries]);
    }

    public function addCountryForm(): View
    {
        return view('settings.countries.create');
    }

    public function addCountry(AddCountryRequest $request): Redirector|RedirectResponse|Application
    {
        $this->countriesService->store($request);

        return redirect(route('countries.index'))->with('status', 'Country added!');
    }

    public function editCountryForm(int $id): Factory|View|Application
    {
        $country = $this->countriesService->getById($id);

        return view('settings.countries.edit', compact([
            'country'
        ]));
    }

    public function editCountry(int $id, EditCountryRequest $request): Redirector|RedirectResponse|Application
    {
        $this->countriesService->update($id, $request);

        return redirect(route('countries.index'))->with('status', 'Country edited!');
    }

    public function deleteCountry(int $id): Redirector|RedirectResponse|Application
    {
        if ($this->countriesService->delete($id) === false){
            return redirect(route('countries.index'))->with('status', 'Error! Cities exist!');
        }

        return redirect(route('countries.index'))->with('status', 'Country deleted!');
    }
}
