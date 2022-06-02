<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AddCountryRequest;
use App\Http\Requests\EditCountryRequest;
use App\Repositories\Interfaces\CountriesRepositoryInterface;

class CountriesController extends Controller
{
    private $countriesRepository;

    public function __construct(CountriesRepositoryInterface $countriesRepository)
    {
        $this->countriesRepository = $countriesRepository;
    }

    public function index()
    {
        $countries = $this->countriesRepository->all();

        return view('settings.countries.index', ['countries' => $countries]);
    }

    public function addCountryForm()
    {
        return view('settings.countries.create');
    }

    public function addCountry(AddCountryRequest $request)
    {
        $this->countriesRepository->add($request);

        return redirect(route('countries.index'))->with('status', 'Country added!');
    }

    public function editCountryForm(int $id)
    {
        $country = $this->countriesRepository->getById((int)$id);

        return view('settings.countries.edit', compact([
            'country'
        ]));
    }

    public function editCountry(int $id, EditCountryRequest $request)
    {
        $this->countriesRepository->update((int) $id, $request);

        return redirect(route('countries.index'))->with('status', 'Country edited!');
    }

    public function deleteCountry(int $id)
    {
        if ($this->countriesRepository->delete((int)$id) === false){
            return redirect(route('countries.index'))->with('status', 'Error! Cities exist!');
        }

        return redirect(route('countries.index'))->with('status', 'Country deleted!');
    }
}
