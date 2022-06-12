<?php

declare(strict_types=1);


namespace App\Http\Controllers;


use App\Http\Requests\CreateVacationRequest;
use App\Http\Requests\UpdateVacationRequest;
use App\Services\Vacation\NumberOfDaysCalculationService;
use App\Services\Vacation\VacationRequestService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class VacationRequestController  extends Controller
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
    ): Redirector|Application|RedirectResponse {
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

        return redirect('/vacations/requestHistory');
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

        $vacationRequestService->updateVacationRequest(
            $vacationRequestId,
            $startDate,
            $endDate,
            $request->get('type')
        );

        return response()->json();
    }

    public function getVacationRequestsByUserId(): Application|Factory|View
    {
        $userId = Auth::id();
        $vacationRequests = $this->vacationRequestService->getVacationRequestsByUserId($userId);

        return view('vacations/vacation_request_history', ['vacationRequests' => $vacationRequests]);
    }

    public function getVacationRequestsForApproval(): Factory|View|Application
    {
        $userId = Auth::id();
        $vacationRequests = $this->vacationRequestService->getVacationRequestsForApproval($userId);

        return view('vacations/vacation_requests_for_approval', ['vacationRequests' => $vacationRequests]);
    }

    public function cancelVacationRequest(int $vacationRequestId): void
    {
        $this->vacationRequestService->cancelVacationRequest($vacationRequestId);
    }

    public function getVacationRequestsForEditing(): Factory|View|Application
    {
        $userId = Auth::id();
        $vacationRequests = $this->vacationRequestService->getVacationRequestsForEditing($userId);

        return view('vacations/vacation_requests_for_editing', ['vacationRequests' => $vacationRequests]);
    }
}
