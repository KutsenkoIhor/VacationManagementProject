<?php

namespace App\Http\Controllers;

use App\Services\HrManagementService;
use App\Services\PmManagementService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HrManagementController extends Controller
{
    private HrManagementService $hrManagementService;

    public function __construct(HrManagementService $hrManagementService)
    {
        $this->hrManagementService = $hrManagementService;
    }

    /**
     * @return Application|Factory|View
     */
    public function listHr(): Application|Factory|View
    {
        return view('pages.manageHR');
    }

    public function createListHr(Request $request): JsonResponse
    {
        $collectionHr = $this->hrManagementService->getCollectionPm($request);
        $data['dataForElasticsearch'] = $this->hrManagementService->getDataForElasticsearch();
        $data['dataForPagination'] = $this->hrManagementService->getArrDataForPagination($collectionHr);
        $data['dataForCreateTable'] = $this->hrManagementService->getArrDataHrInformation($collectionHr);
        return response()->json($data);
    }

    public function locationManagementHr(Request $request): JsonResponse
    {
        $data = $this->hrManagementService->getListLocationHr($request->get('hrId'));
        return response()->json($data);
    }


}
