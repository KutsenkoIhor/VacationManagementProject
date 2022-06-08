<?php

namespace App\Http\Controllers;

use App\Http\Requests\deleteUserRequest;
use App\Http\Requests\SaveNewUserRequest;
use App\Http\Requests\UpdateNewUserRequest;
use App\Services\ListEmployeesService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListEmployeesController extends Controller
{
    private ListEmployeesService $listEmployeesService;

    public function __construct(ListEmployeesService $listEmployeesService)
    {
        $this->listEmployeesService = $listEmployeesService;
    }

    /**
     * @return Factory|View|Application
     */
    public function listEmployees(): Factory|View|Application
    {
        $arrData['arr'] =  $this->listEmployeesService->getRolesAndDays();
        $arrData ['countries'] = $this->listEmployeesService->getCountries();
        return view('pages.listOfAllEmployeesPage', ['arrData' => $arrData]);
    }

    /**
     * @return JsonResponse
     */
    public function addUser(): JsonResponse
    {
        $arrData = $this->listEmployeesService->getRolesAndDays();
        $arrData['CountriesAndCities'] = $this->listEmployeesService->getCountriesAndCities();
        return response()->json($arrData);
    }

    /**
     * @param SaveNewUserRequest $request
     * @return JsonResponse
     */
    public function saveUser(SaveNewUserRequest $request): JsonResponse
    {
        $idCountry = $this->listEmployeesService->getIdCountry($request);
        $idCity = $this->listEmployeesService->getIdCity($idCountry, $request);
        $transactionSaveUser = $this->listEmployeesService->saveUser($request, $idCountry, $idCity);
        return response()->json($transactionSaveUser);
    }

    /**
     * @param deleteUserRequest $request
     * @return JsonResponse
     */
    public function deleteUser(deleteUserRequest $request): JsonResponse
    {
        $transactionDeleteUser = $this->listEmployeesService->deleteUser($request->get('userId'));
        return response()->json($transactionDeleteUser);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function UserInformationForEdit(Request $request): JsonResponse
    {
        $userInformation['roleAndDaysUser'] = $this->listEmployeesService->getRolesAndDays();
        $userInformation['roleAndDaysUser']['CountriesAndCities'] = $this->listEmployeesService->getCountriesAndCities();
        $userInformation['informationUser'] = $this->listEmployeesService->getEmployeeInformationById($request->get('userId'));
        return response()->json($userInformation);
    }

    /**
     * @param UpdateNewUserRequest $request
     * @return JsonResponse
     */
    public function updateUser(UpdateNewUserRequest $request): JsonResponse
    {
        $idCountry = $this->listEmployeesService->getIdCountry($request);
        $idCity = $this->listEmployeesService->getIdCity($idCountry, $request);
        $transactionUpdateUser = $this->listEmployeesService->updateUser($request, $idCountry, $idCity);
        return response()->json($transactionUpdateUser);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getPaginateAndElasticsearchData(Request $request): JsonResponse
    {
        $usersInformation = $this->listEmployeesService->listEmployeesInformation($request);
        $paginateAndElasticsearchData['dataForElasticsearch'] = $this->listEmployeesService->dataForElasticsearch();
        $paginateAndElasticsearchData['userModel'] = $usersInformation['userModel'];
        return response()->json($paginateAndElasticsearchData);
    }

    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function createEmployeeDataTable(Request $request): Factory|View|Application
    {
        $usersInformation = $this->listEmployeesService->listEmployeesInformation($request);
        $arrData['user parameters'] = $usersInformation['userInfo'];
        return view('listEmployees.tableListEmployees', ['arrData' => $arrData]);
    }
}
