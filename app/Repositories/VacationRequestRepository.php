<?php

declare(strict_types=1);

namespace App\Repositories;

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

    public function getVacationRequest(int $vacationRequestId): VacationRequestDTO
    {
        return $this->vacationRequestFactory->makeDTOFromModel(VacationRequest::findOrFail($vacationRequestId));
    }

    public function updateVacationRequest(
        int $vacationRequestId,
        Carbon $startDate,
        Carbon $endDate,
        int $numberOfDays,
        string $type
    ): VacationRequestDTO {
        /** @var VacationRequest $vacationRequest */
        $vacationRequest = VacationRequest::findOrFail($vacationRequestId);

        $vacationRequest->start_date = $startDate;
        $vacationRequest->end_date = $endDate;
        $vacationRequest->number_of_days = $numberOfDays;
        $vacationRequest->type = $type;

        $vacationRequest->save();

        return $vacationRequest->is_approved == null ? $this->vacationRequestFactory->makeDTOFromModel($vacationRequest) : throw new \Exception('You can`t update approved or denied vacation request!');
    }

    public function getVacationRequestsByUserId(int $userId): array
    {
        return $this->vacationRequestFactory->makeDTOFromModelCollection(VacationRequest::where('user_id', $userId)->get());
    }

    public function getEmployeesVacationRequestsForHR(int $userId, array $usersFromCity): array
    {
        $vacationRequests = VacationRequest::with('user')
            ->where('user_id', '!=', $userId)
            ->where(function ($query) use ($usersFromCity) {
                $query->whereIn('user_id', $usersFromCity);
            })
            ->get();

        return $this->vacationRequestFactory->makeDTOFromModelCollection($vacationRequests);
    }

    public function getEmployeesVacationRequestsForPM(int $userId, array $employeeIDs): array
    {
        //we can make join except 2 queries

        $vacationRequests = VacationRequest::whereIn('user_id', $employeeIDs)
            ->get();

        return $this->vacationRequestFactory->makeDTOFromModelCollection($vacationRequests);
    }

    public function denyVacationRequest(int $vacationRequestId): VacationRequestDTO
    {
        /** @var VacationRequest $vacationRequest */
        $vacationRequest = VacationRequest::findOrFail($vacationRequestId);

        $vacationRequest->is_approved = false;

        $vacationRequest->save();

        return $this->vacationRequestFactory->makeDTOFromModel($vacationRequest);
    }

    public function approveVacationRequest(int $vacationRequestId): VacationRequestDTO
    {
        /** @var VacationRequest $vacationRequest */
        $vacationRequest = VacationRequest::findOrFail($vacationRequestId);

        $vacationRequest->is_approved = true;

        $vacationRequest->save();

        return $this->vacationRequestFactory->makeDTOFromModel($vacationRequest);
    }

    public function cancelVacationRequest(int $vacationRequestId): VacationRequestDTO
    {
        /** @var VacationRequest $vacationRequest */
        $vacationRequest = VacationRequest::findOrFail($vacationRequestId);

        $vacationRequest->delete();

        return $this->vacationRequestFactory->makeDTOFromModel($vacationRequest);
    }
}
