<?php

declare(strict_types=1);

namespace App\Repositories\Vacation;

use App\DTO\Vacation\VacationDTO;
use App\Interfaces\VacationRepositoryInterface;
use App\Models\Vacation;
use App\Repositories\Vacation\Factory\VacationFactory;
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
}
