<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateVacationRequest;
use App\Http\Requests\UpdateVacationRequest;
use App\Services\Vacation\NumberOfDaysCalculationService;
use App\Services\Vacation\VacationRequestService;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class VacationRequestController extends Controller
{
    private VacationRequestService $vacationRequestService;
    private NumberOfDaysCalculationService $numberOfDaysCalculationService;

    public function __construct(
        VacationRequestService $vacationRequestService,
        NumberOfDaysCalculationService $numberOfDaysCalculationService
    ) {
        $this->vacationRequestService = $vacationRequestService;
        $this->numberOfDaysCalculationService = $numberOfDaysCalculationService;
    }

    public function createVacationRequest(
        CreateVacationRequest $request,
        VacationRequestService $vacationRequestService
    ): JsonResponse {
        $startDate = Carbon::createFromFormat("Y-m-d", $request->get('start_date'));
        $endDate = Carbon::createFromFormat("Y-m-d", $request->get('end_date'));
        $userId = Auth::id();

        $vacationDaysNumberDTO = $this->numberOfDaysCalculationService->getNumberOfVacationRequestDays(
            $userId,
            clone $startDate,
            clone $endDate,
            clone $startDate,
        );

        //TODO: validate amount of vacation request days

        $vacationRequestService->createVacationRequest(
            $userId,
            $startDate,
            $endDate,
            $vacationDaysNumberDTO->getNumberOfDays(),
            $request->get('type')
        );

        return response()->json();
    }

    public function getVacationRequest(int $vacationRequestId): JsonResponse
    {
        return response()->json(
            $this->vacationRequestService->getVacationRequest($vacationRequestId)
        );
    }

    public function updateVacationRequest(
        int $vacationRequestId,
        UpdateVacationRequest $request,
        VacationRequestService $vacationRequestService
    ): JsonResponse
    {
        $startDate = Carbon::createFromFormat("Y-m-d", $request->get('start_date'));
        $endDate = Carbon::createFromFormat("Y-m-d", $request->get('end_date'));
        $userId = Auth::id();

        $vacationDaysNumberDTO = $this->numberOfDaysCalculationService->getNumberOfVacationRequestDays(
            $userId,
            clone $startDate,
            clone $endDate,
            clone $startDate,
        );

        //TODO: validate amount of vacation request days
        $vacationRequestService->updateVacationRequest(
            $userId,
            $vacationRequestId,
            $startDate,
            $endDate,
            $vacationDaysNumberDTO->getNumberOfDays(),
            $request->get('type')
        );

        return response()->json();
    }

    public function getVacationRequestsByUserId(): Application|Factory|View
    {
        $vacationRequests = $this->vacationRequestService->getVacationRequestsByUserId(Auth::id());

        return view('vacations/vacation_request_history', ['vacationRequests' => $vacationRequests]);
    }

    public function cancelVacationRequest(int $vacationRequestId): void
    {
        $this->vacationRequestService->cancelVacationRequest($vacationRequestId, Auth::id());
    }

    public function getEmployeesVacationRequests(): Factory|View|Application
    {
        $vacationRequests = $this->vacationRequestService->getEmployeesVacationRequests(Auth::id());

        try {
            $this->vacationRequestService->getEmployeesVacationRequests(Auth::id());
        } catch (Exception $e) {
            return redirect(route('page.homePage'));
        }

        return view('vacations/employees_vacation_requests', ['vacationRequests' => $vacationRequests]);
    }
}
