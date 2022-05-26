<?php

declare(strict_types=1);

namespace App\Repositories\Vacation;

use App\Factories\VacationFactory;
use App\Models\Vacation;
use App\Models\VacationRequest;
use App\Repositories\Interfaces\VacationRepositoryInterface;
use Carbon\Carbon;


class VacationRepository implements VacationRepositoryInterface
{
    private VacationFactory $vacationFactory;

    public function __construct(VacationFactory $vacationFactory)
    {
        $this->vacationFactory = $vacationFactory;
    }

    public function createVacation(int $vacationRequestId): void
    {
        /** @var VacationRequest $vacationRequest */
        $vacationRequest = VacationRequest::findOrFail($vacationRequestId);

        $vacation = new Vacation();

        $vacation->user_id = $vacationRequest->user_id;
        $vacation->vacation_request_id = $vacationRequest->id;
        $vacation->start_date = $vacationRequest->start_date;
        $vacation->end_date = $vacationRequest->end_date;
        $vacation->number_of_days = $vacationRequest->number_of_days;
        $vacation->type = $vacationRequest->type;

        $vacation->save();
    }

    public function getUpcomingVacations(Carbon $startDate, Carbon $endDate): array
    {
        return $this->vacationFactory->makeDTOFromModelCollection(Vacation::whereBetween('start_date', [$startDate, $endDate])
            ->orWhereBetween('end_date', [$startDate,  $endDate])
            ->with('user') //TODO think about performance
            ->get());
    }

}
