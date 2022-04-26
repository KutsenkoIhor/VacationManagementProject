<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateVacationRequest;
use App\Http\Requests\UpdateVacationRequest;
use App\Services\Vacation\VacationService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class VacationController extends Controller
{
    public function createVacation(CreateVacationRequest $request, VacationService $vacationService)
    {
        $startDate = Carbon::createFromFormat("Y-m-d", $request->get('start_date'));
        $endDate = Carbon::createFromFormat("Y-m-d", $request->get('end_date'));
        $userId = 1; //TODO take id of logged in user

        $vacationService->createVacation(
            $userId,
            $startDate,
            $endDate,
            $request->get('type')
        );

        return redirect('/vacationList/'.$userId);
    }

    public function getVacations(VacationService $vacationService): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $vacationService->getVacations()
        ]);
    }

    public function getVacation(int $id, VacationService $vacationService): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $vacationService->getVacation($id)
        ]);
    }

    public function getVacationsByUserId(
        int $userId,
        VacationService $vacationService
    ): Application|Factory|View {
        $vacations = $vacationService->getVacationsByUserId($userId);

        return view('vacations/vacation_list', ['vacations' => $vacations]);
    }

    public function updateVacation(int $id, UpdateVacationRequest $request, VacationService $vacationService): JsonResponse
    {
        $startDate = Carbon::createFromFormat(DATE_W3C, $request->get('start_date'))->startOfDay();
        $endDate = Carbon::createFromFormat(DATE_W3C, $request->get('end_date'))->endOfDay(); //TODO do we need it ?

        $vacationDTO = $vacationService->updateVacation(
            $id,
            $request->get('user_id'),
            $startDate,
            $endDate,
            $request->get('type')
        );

        return response()->json([
            'success' => true,
            'vacation' => $vacationDTO
        ]);
    }

    public function deleteVacation(int $id, VacationService $vacationService): JsonResponse
    {
        $vacationService->deleteVacation($id);

        return response()->json([
            'success' => true
        ]);
    }
}
