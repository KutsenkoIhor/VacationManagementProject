<?php

namespace App\Http\Controllers;

use App\Http\Requests\deleteUserRequest;
use App\Http\Requests\SaveNewUserRequest;
use App\Interfaces\CountryRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Services\ListEmployeesService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListEmployeesController extends Controller
{
    private CountryRepositoryInterface $countryRepository;
    private RoleRepositoryInterface $roleRepository;
    private ListEmployeesService $listEmployeesService;


    public function __construct(
        CountryRepositoryInterface $countryRepository,
        RoleRepositoryInterface $roleRepository,
        ListEmployeesService $listEmployeesService,
    )
    {
        $this->countryRepository = $countryRepository;
        $this->roleRepository = $roleRepository;
        $this->listEmployeesService = $listEmployeesService;
    }

    public function listEmployees(): Factory|View|Application
    {
        $dataCountries = $this->countryRepository->orderBy('title');
        $dataRole = $this->roleRepository->all();

        $arrData = $this->listEmployeesService->modalWindow($dataCountries, $dataRole);
//        $arrData['user parameters'] = $this->listEmployeesService->listEmployeesInformation();
//        dd($arrData);
        return view('pages.listOfAllEmployeesPage', ['arrData' => $arrData]);
    }

    public function getEmployeeDataTable(): Factory|View|Application
    {
        $x = $this->listEmployeesService->listEmployeesInformation();
        $arrData['user parameters'] = $x['userInfo'];

        return view('listEmployees.tableListEmployees', ['arrData' => $arrData]);
//        return view('pages.listOfAllEmployeesPage', ['arrData' => $arrData]);
    }

    public function getPaginateData(): JsonResponse
    {
        $x = $this->listEmployeesService->listEmployeesInformation();
        $dataForElasticsearch = $this->listEmployeesService->dataForElasticsearch();
        $arr['userModel'] = $x['userModel'];
        $arr['dataForElasticsearch'] = $dataForElasticsearch;
//        $arr = [$x['userModel'], $dataForElasticsearch];
        return response()->json($arr);

    }

    public function addUser(): JsonResponse
    {
        $dataCountriesAndCities = $this->countryRepository->all();
        $dataRole = $this->roleRepository->all();

        return $this->listEmployeesService->addNewUser($dataCountriesAndCities, $dataRole);
    }

    public function saveUser(SaveNewUserRequest $request): JsonResponse
    {
        $idCountry = $this->listEmployeesService->takeIdCountry($request);
        $idCity = $this->listEmployeesService->takeIdCity($idCountry, $request);

        return $this->listEmployeesService->saveUser($request, $idCountry, $idCity);
    }

    public function deleteUser(deleteUserRequest $request): JsonResponse
    {
        return $this->listEmployeesService->deleteUser($request->get('userId'));
    }

    public function getInformationUserForEdit(Request $request): JsonResponse
    {
        $employeeInformation = $this->listEmployeesService->employeeInformationById($request->get('userId'));
        return response()->json($employeeInformation);
    }

}
