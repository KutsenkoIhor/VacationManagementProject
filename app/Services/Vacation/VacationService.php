<?php

declare(strict_types=1);

namespace App\Services\Vacation;

use App\DTO\Vacation\VacationDTO;
use App\Models\Vacation;
use App\Repositories\Interfaces\VacationRepositoryInterface;
use Carbon\Carbon;

class VacationService
{
    private VacationRepositoryInterface $vacationRepository;

    public function __construct(VacationRepositoryInterface $vacationRepository)
    {
        $this->vacationRepository = $vacationRepository;
    }

    public function createVacation(
        int $userId,
        Carbon $startDate,
        Carbon $endDate,
        string $type
    ) : VacationDTO {
        $numberOfDays = 4; //TODO create NumberOfDaysCalculationService [weekends, holidays etc.]

        return $this->vacationRepository->createVacation(
            $userId,
            $startDate,
            $endDate,
            $numberOfDays,
            $type
        );
    }

    public function getVacations(): array
    {
        return $this->vacationRepository->getVacations();
    }

    public function getVacation(int $id): VacationDTO
    {
        return $this->vacationRepository->getVacation($id);
    }

    public function getVacationsByUserId(int $id): array
    {
        return $this->vacationRepository->getVacationsByUserId($id);
    }

    public function getUpcomingVacations(Carbon $startDate, Carbon $endDate): array
    {
        $vacationIntervals = $this->vacationRepository->getUpcomingVacations($startDate, $endDate);

        $userDates = [];
        $users = [];

        foreach ($vacationIntervals as $vacationInterval) {

            if ($vacationInterval->getStatus() != Vacation::STATUS_APPROVED) {
                continue; //TODO filter in DB query instead of filtering in PHP
            }

            $dates = [];
            for ($i = $vacationInterval->getStartDate(); $i <= $vacationInterval->getEndDate(); $i = $i->addDay()) {
                $dates[$i->format(config('vacation.date_format'))] = $vacationInterval->getType();
            }

            if (array_key_exists($vacationInterval->getUserId(), $userDates)) {
                $userDates[$vacationInterval->getUserId()] = array_merge($userDates[$vacationInterval->getUserId()], $dates);
            } else {
                $userDates[$vacationInterval->getUserId()] = $dates;
            }

            $users[$vacationInterval->getUserId()] = $vacationInterval->getUser(); //put user model to be able to access it in blade
        }

        $columns = [];

        for ($i = $startDate; $i <= $endDate; $i = $i->addDay()) {
            $columns[] = $i->format(config('vacation.date_format'));
        }

        return ['users' => $users, 'columns' => $columns, 'userDates' => $userDates];
    }

    public function getVacationsWithStatusNew(): array
    {
        return $this->vacationRepository->getVacationsWithStatusNew();
    }

    public function changeStatus(int $id, string $status)
    {
        return $this->vacationRepository->changeStatus($id, $status);
    }

    public function updateVacation(
        int $id,
        Carbon $startDate,
        Carbon $endDate,
        string $type
    ) : VacationDTO  {

        $numberOfDays = 4; //TODO create NumberOfDaysCalculationService [weekends, holidays etc.]

        return $this->vacationRepository->updateVacation(
            $id,
            $startDate,
            $endDate,
            $numberOfDays,
            $type
        );
    }

    public function deleteVacation(int $id)
    {
        return $this->vacationRepository->deleteVacation($id);
    }
}
