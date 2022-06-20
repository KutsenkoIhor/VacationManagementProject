<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddEmployeeToTheTeamPm;
use App\Services\PmManagementService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PmManagementController extends Controller
{
    private PmManagementService $pmManagementService;

    public function __construct(PmManagementService $pmManagementService)
    {
        $this->pmManagementService = $pmManagementService;
    }

    /**
     * @return Application|Factory|View
     */
    public function listPm(): Application|Factory|View
    {
        return view('pages.managePM');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createListPm(Request $request): JsonResponse
    {
        $collectionPm = $this->pmManagementService->getCollectionPm($request);
        $data['dataForElasticsearch'] = $this->pmManagementService->getDataForElasticsearch();
        $data['dataForPagination'] = $this->pmManagementService->getArrDataForPagination($collectionPm);
        $data['dataForCreateTable'] = $this->pmManagementService->getArrDataPmInformation($collectionPm);
        return response()->json($data);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createTeamPm(Request $request): JsonResponse
    {
        $data = $this->pmManagementService->getTeamInformation($request->get('pmId'));
        return response()->json($data);
    }

    /**
     * @param AddEmployeeToTheTeamPm $request
     * @return JsonResponse
     */
    public function addEmployeeInTeam(AddEmployeeToTheTeamPm $request): JsonResponse
    {
        $bool = $this->pmManagementService->addEmployee($request->get('idPm'), $request->get('emailEmployee'));
        return response()->json($bool);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function removeEmployeeFromTeam(Request $request): JsonResponse
    {
        $bool = $this->pmManagementService->removeEmployee($request->get('idPm'), $request->get('idEmployee'));
        return response()->json($bool);
    }

}
