<?php

declare(strict_types=1);

namespace App\Services\Vacation;

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

            if ($vacationInterval->isApproved() != true) {
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

    public function createVacation(int $vacationRequestId): void
    {
        $this->vacationRepository->createVacation($vacationRequestId);
    }
}
