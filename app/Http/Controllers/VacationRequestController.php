<?php

declare(strict_types=1);


namespace App\Http\Controllers;


use App\Http\Requests\CreateVacationRequest;
use App\Services\Vacation\VacationRequestService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class VacationRequestController  extends Controller
{
    private VacationRequestService $vacationRequestService;

    public function __construct(VacationRequestService $vacationRequestService)
    {
        $this->vacationRequestService = $vacationRequestService;
    }

    public function createVacationRequest(
        CreateVacationRequest $request,
        VacationRequestService $vacationRequestService
    ): Redirector|Application|RedirectResponse
    {
        $startDate = Carbon::createFromFormat("Y-m-d", $request->get('start_date'));
        $endDate = Carbon::createFromFormat("Y-m-d", $request->get('end_date'));
        $userId = Auth::id();

        //TODO:: CalculationService
        $numberOfDays = 4;

        $vacationRequestService->createVacationRequest(
            $userId,
            $startDate,
            $endDate,
            $numberOfDays,
            $request->get('type')
        );

        return redirect('/vacations/history');
    }

    public function getVacationRequestsByUserId(): array
    {
        $userId = Auth::id();

        return $this->vacationRequestService->getVacationRequestsByUserId($userId);
    }

    public function getVacationRequestsForApproval(): Factory|View|Application
    {
        $userId = Auth::id();
        $vacationRequests = $this->vacationRequestService->getVacationRequestsForApproval($userId);

        return view('vacations/vacation_status', ['vacationRequests' => $vacationRequests]);
    }
}
