<?php

declare(strict_types=1);

namespace App\Services\Vacation;

use App\DTO\VacationDTO;

use App\Repositories\Interfaces\VacationRepositoryInterface;
use Carbon\Carbon;

class VacationService
{
    private VacationRepositoryInterface $vacationRepository;

    public function __construct(VacationRepositoryInterface $vacationRepository)
    {
        $this->vacationRepository = $vacationRepository;
    }

    public function getUpcomingVacations(Carbon $startDate, Carbon $endDate): array
    {
        $vacationIntervals = $this->vacationRepository->getUpcomingVacations($startDate, $endDate);

        $userDates = [];
        $users = [];

        foreach ($vacationIntervals as $vacationInterval) {
            /** @var VacationDTO $vacationInterval */
            $dates = [];
            for ($i = $vacationInterval->getStartDate(); $i <= $vacationInterval->getEndDate(); $i = $i->addDay()) {
                $dates[$i->format(config('vacation.date_format'))] = $vacationInterval->getType();
            }

            if (array_key_exists($vacationInterval->getUser()->getId(), $userDates)) {
                $userDates[$vacationInterval->getUser()->getId()] = array_merge($userDates[$vacationInterval->getUser()->getId()], $dates);
            } else {
                $userDates[$vacationInterval->getUser()->getId()] = $dates;
            }

            $users[$vacationInterval->getUser()->getId()] = $vacationInterval->getUser(); //put user model to be able to access it in blade
        }

        $columns = [];

        for ($i = $startDate; $i <= $endDate; $i = $i->addDay()) {
            $columns[] = $i->format(config('vacation.date_format'));
        }

        return ['users' => $users, 'columns' => $columns, 'userDates' => $userDates];
    }

    public function createVacation(int $vacationRequestId): void
    {
        $this->vacationRepository->createVacation($vacationRequestId);
    }

    public function getVacationsByUserId(int $userId): array
    {
        return $this->vacationRepository->getVacationsByUserId($userId);
    }
}
