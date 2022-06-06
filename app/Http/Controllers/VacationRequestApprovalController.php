<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateVacationRequestApprovalRequest;
use App\Services\Vacation\VacationRequestApprovalService;
use Illuminate\Support\Facades\Auth;

class VacationRequestApprovalController
{
    public function createVacationRequestApproval(
        int $vacationRequestId,
        CreateVacationRequestApprovalRequest $request,
        VacationRequestApprovalService $vacationRequestApprovalService
    ) {
        $vacationRequestApprovalService->createVacationRequestApproval(
            $vacationRequestId,
            Auth::id(),
            (int) $request->get('is_approved')
        );

        //TODO return empty response with 200 http status
    }
}
