<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateVacationRequest;
use App\Http\Requests\UpdateVacationRequest;
use App\Http\Requests\UpcomingVacationsRequest;
use App\Models\Vacation;
use App\Services\Vacation\VacationService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class VacationController extends Controller
{
    public function createVacation(CreateVacationRequest $request, VacationService $vacationService): Redirector|Application|RedirectResponse
    {
        $startDate = Carbon::createFromFormat("Y-m-d", $request->get('start_date'));
        $endDate = Carbon::createFromFormat("Y-m-d", $request->get('end_date'));
        $userId = Auth::id();

        $vacationService->createVacation(
            $userId,
            $startDate,
            $endDate,
            $request->get('type')
        );

        return redirect('/vacations/history');
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

    public function getVacationsByUserId(VacationService $vacationService): Application|Factory|View
    {
        $vacations = $vacationService->getVacationsByUserId(Auth::id());

        return view('vacations/vacation_list', ['vacations' => $vacations]);
    }

    public function getUpcomingVacations(UpcomingVacationsRequest $request, VacationService $vacationService): Application|Factory|View
    {
        $startDate = $request->get('start_date') ? Carbon::createFromFormat("Y-m-d", $request->get('start_date')) : Carbon::now();
        $endDate = $request->get('end_date') ? Carbon::createFromFormat("Y-m-d", $request->get('end_date')) : Carbon::today()->addMonth();

        $parameters = $vacationService->getUpcomingVacations(clone $startDate, clone $endDate);

        $typeMapping = [
            Vacation::TYPE_VACATIONS     => 'V',
            Vacation::TYPE_SICK_DAYS     => 'SD',
            Vacation::TYPE_PERSONAL_DAYS => 'PD',
        ];

        //TODO:: add styles to css
        $typeMappingStyles = [
            Vacation::TYPE_VACATIONS     => 'bg-purple-100',
            Vacation::TYPE_SICK_DAYS     => 'bg-red-50',
            Vacation::TYPE_PERSONAL_DAYS => 'bg-blue-100',
        ];

        return view('vacations/upcoming-vacations', ['typeMapping' => $typeMapping, 'typeMappingStyles' => $typeMappingStyles, 'startDate' => $startDate, 'endDate' => $endDate], $parameters);
    }

    public function updateVacation(int $id, UpdateVacationRequest $request, VacationService $vacationService): JsonResponse
    {
        $startDate = Carbon::createFromFormat("Y-m-d", $request->get('start_date'));
        $endDate = Carbon::createFromFormat("Y-m-d", $request->get('end_date'));

        $vacationDTO = $vacationService->updateVacation(
            $id,
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
