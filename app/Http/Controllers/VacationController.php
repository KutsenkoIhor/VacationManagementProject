<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateVacationRequest;
use App\Services\Vacation\VacationService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class VacationController extends Controller
{
    public function createVacation(CreateVacationRequest $request, VacationService $vacationService): JsonResponse
    {
        $startDate = Carbon::createFromFormat(DATE_W3C, $request->get('start_date'))->startOfDay();
        $endDate = Carbon::createFromFormat(DATE_W3C, $request->get('end_date'))->endOfDay(); //TODO do we need it ?

        $vacationDTO = $vacationService->createVacation(
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
}
