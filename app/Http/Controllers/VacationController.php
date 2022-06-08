<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpcomingVacationsRequest;
use App\Models\Vacation;
use App\Services\Vacation\VacationDaysLeftCalculationService;
use App\Services\Vacation\VacationService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class VacationController extends Controller
{
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
}
