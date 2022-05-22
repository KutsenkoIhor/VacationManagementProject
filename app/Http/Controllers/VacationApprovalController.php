<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateVacationApprovalRequest;
use App\Services\Vacation\VacationApprovalService;
use App\Services\Vacation\VacationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class VacationApprovalController
{
    public function createVacationApproval(int $vacationId, CreateVacationApprovalRequest $request, VacationService $vacationService): Application|Factory|View
    {
        $vacations = $vacationService->createVacationApproval($vacationId, Auth::id(), (int)$request->get('number_of_days'), $request->get('status'));

        return view('/vacations/vacation_status', ['vacations' => $vacations]);
    }

    //TODO:: remove
    public function getVacationApprovalByRole(VacationApprovalService $vacationApprovalService): JsonResponse
    {
        $vacationApprovalService->approveVacation(5);

        return response()->json([
            'success' => true
        ]);
    }
}
