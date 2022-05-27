<?php

declare(strict_types=1);


namespace App\Repositories\Vacation;


use App\DTO\VacationRequestDTO;
use App\Factories\VacationRequestFactory;
use App\Models\VacationRequest;
use App\Repositories\Interfaces\VacationRequestRepositoryInterface;
use Carbon\Carbon;

class VacationRequestRepository implements VacationRequestRepositoryInterface
{
    private VacationRequestFactory $vacationRequestFactory;

    public function __construct(VacationRequestFactory $vacationRequestFactory)
    {
        $this->vacationRequestFactory = $vacationRequestFactory;
    }

    public function createVacationRequest(
        int $userId,
        Carbon $startDate,
        Carbon $endDate,
        int $numberOfDays,
        string $type
    ): VacationRequestDTO {
        $vacationRequest = new VacationRequest();

        $vacationRequest->user_id = $userId;
        $vacationRequest->start_date = $startDate;
        $vacationRequest->end_date = $endDate;
        $vacationRequest->number_of_days = $numberOfDays;
        $vacationRequest->type = $type;
        $vacationRequest->is_approved = null;

        $vacationRequest->save();

        return $this->vacationRequestFactory->makeDTOFromModel($vacationRequest);
    }

    public function getVacationRequestsByUserId(int $userId): array
    {
        return $this->vacationRequestFactory->makeDTOFromModelCollection(VacationRequest::where('user_id', $userId)->get());
    }

    public function getVacationRequestsForApproval(int $userId): array
    {
        $vacationRequests = VacationRequest::where('is_approved', null)
            ->with('user') //TODO think about performance
            ->get();


        return $this->vacationRequestFactory->makeDTOFromModelCollection($vacationRequests);
    }

    public function denyVacationRequest($vacationRequestId): void
    {
        /** @var VacationRequest $vacationRequest */
        $vacationRequest = VacationRequest::findOrFail($vacationRequestId);

        $vacationRequest->is_approved = false;

        $vacationRequest->save();
    }

    public function approveVacationRequest($vacationRequestId): void
    {
        /** @var VacationRequest $vacationRequest */
        $vacationRequest = VacationRequest::findOrFail($vacationRequestId);

        $vacationRequest->is_approved = true;

        $vacationRequest->save();
    }
}
