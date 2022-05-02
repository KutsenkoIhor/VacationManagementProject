<?php

declare(strict_types=1);

namespace App\Services\Vacation;

use App\DTO\Vacation\VacationDTO;
use App\Interfaces\VacationRepositoryInterface;
use App\Models\Vacation;
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
                $dates[$i->format('M.d,Y')] = $vacationInterval->getType(); //TODO move date format to a config
            }

            if (array_key_exists($vacationInterval->getUserId(), $userDates)) {
                $userDates[$vacationInterval->getUserId()] = array_merge($userDates[$vacationInterval->getUserId()], $dates);
            } else {
                $userDates[$vacationInterval->getUserId()] = $dates;
            }

            $users[$vacationInterval->getUserId()] = $vacationInterval->user; //put user model to be able to access it in blade
        }

        $columns = [];

        for ($i = $startDate; $i <= $endDate; $i = $i->addDay()) {
            $columns[] = $i->format('M.d,Y'); //TODO:: date format with space. Also move to config
        }

        return ['users' => $users, 'columns' => $columns, 'userDates' => $userDates];
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
