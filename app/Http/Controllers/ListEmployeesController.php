<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveNewUserRequest;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\CountryRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Models\City;
use App\Models\Country;
use App\Models\Role;
use App\Repositories\UserRepository;
use App\Repositories\VacationDaysPerYearRepository;
use App\Services\ListEmployeesService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ListEmployeesController extends Controller
{
    private CountryRepositoryInterface $countryRepository;
    private RoleRepositoryInterface $roleRepository;
    private ListEmployeesService $listEmployeesService;
    private CityRepositoryInterface $cityRepository;
    private UserRepository $userRepository;
    private VacationDaysPerYearRepository $vacationDaysPerYearRepository;


    public function __construct(
        CountryRepositoryInterface $countryRepository,
        RoleRepositoryInterface $roleRepository,
        ListEmployeesService $listEmployeesService,
        CityRepositoryInterface $cityRepository,
        UserRepository $userRepository,
        VacationDaysPerYearRepository $vacationDaysPerYearRepository,
    )

    {
        $this->countryRepository = $countryRepository;
        $this->roleRepository = $roleRepository;
        $this->listEmployeesService = $listEmployeesService;
        $this->cityRepository = $cityRepository;
        $this->userRepository = $userRepository;
        $this->vacationDaysPerYearRepository = $vacationDaysPerYearRepository;
    }

    public function listEmployees(): Factory|View|Application
    {
        $dataCountries = $this->countryRepository->orderBy('title');
        $dataRole = $this->roleRepository->all();

        $arrData = $this->listEmployeesService->createListEmployees($dataCountries, $dataRole);

        return view('pages.listOfAllEmployeesPage', ['arrRolee' => $arrData]);
    }

    public function addUser(): JsonResponse
    {
        $dataCountriesAndCities = $this->countryRepository->all();
        $dataRole = $this->roleRepository->all();

        return $this->listEmployeesService->addNewUser($dataCountriesAndCities, $dataRole);
    }

    public function saveUser(SaveNewUserRequest $request): JsonResponse
    {
        $collectionCountry = $this->countryRepository->searchByCountry($request->get('country'));
        $idCountry = $this->listEmployeesService->takeIdCountry($collectionCountry);

        $collectionCity = $this->cityRepository->searchByCountryIdAndCity($idCountry, $request->get('city'));
        $idCity = $this->listEmployeesService->takeIdCity($collectionCity);

        DB::transaction(function () use ($request, $idCountry, $idCity) {
            $modelUser = $this->userRepository->createUser(
                $request->get('firstName'),
                $request->get('lastName'),
                $request->get('email'),
                null,
                $idCountry,
                $idCity,
            );

            foreach ($request->get('roles') as $role) {
                $modelUser->assignRole($role);
            }

            $idUser = $modelUser["id"];

            $this->vacationDaysPerYearRepository->create($idUser, $request->get('vacationDays'), $request->get('personalDays'), $request->get('sickDays'));
        });


        return $this->listEmployeesService->saveUser($request, $idCountry, $idCity);

    }
}
