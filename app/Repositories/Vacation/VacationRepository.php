<?php

declare(strict_types=1);

namespace App\Repositories\Vacation;

use App\DTO\Vacation\VacationDTO;
use App\Factories\VacationFactory;
use App\Interfaces\VacationRepositoryInterface;
use App\Models\Vacation;
use Carbon\Carbon;


class VacationRepository implements VacationRepositoryInterface
{
    private VacationFactory $vacationFactory;

    public function __construct(VacationFactory $vacationFactory)
    {
        $this->vacationFactory = $vacationFactory;
    }

    public function createVacation(
        int $userId,
        Carbon $startDate,
        Carbon $endDate,
        int $numberOfDays,
        string $type
    ): VacationDTO {
        $vacation = new Vacation();

        $vacation->user_id = $userId;
        $vacation->start_date = $startDate;
        $vacation->end_date = $endDate;
        $vacation->number_of_days = $numberOfDays;
        $vacation->type = $type;
        $vacation->status = Vacation::STATUS_NEW;

        $vacation->save();

        return $this->vacationFactory->makeDTOFromModel($vacation);
    }

    public function getVacations(): array
    {
        return $this->vacationFactory->makeDTOFromModelCollection(Vacation::all());
    }

    public function getVacation(int $id): VacationDTO
    {
        return $this->vacationFactory->makeDTOFromModel(Vacation::findOrFail($id));
    }

    public function getVacationsByUserId(int $id): array
    {
        return $this->vacationFactory->makeDTOFromModelCollection(Vacation::where('user_id', $id)->get());
    }

    public function getUpcomingVacations(Carbon $startDate, Carbon $endDate): array
    {
        return $this->vacationFactory->makeDTOFromModelCollection(Vacation::whereBetween('start_date', [$startDate, $endDate])
            ->orWhereBetween('end_date', [$startDate,  $endDate])
            ->with('user') //TODO think about performance
            ->get());
    }

    public function updateVacation(
        int $id,
        Carbon $startDate,
        Carbon $endDate,
        int $numberOfDays,
        string $type
    ): VacationDTO {

        $vacation = Vacation::findOrFail($id);

        $vacation->start_date = $startDate;
        $vacation->end_date = $endDate;
        $vacation->number_of_days = $numberOfDays;
        $vacation->type = $type;
        $vacation->status = Vacation::STATUS_NEW;

        $vacation->save();

        return $this->vacationFactory->makeDTOFromModel($vacation);
    }

    public function deleteVacation(int $id): void
    {
        Vacation::findOrFail($id)->delete();
    }

}
