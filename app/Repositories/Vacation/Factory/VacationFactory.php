<?php

declare(strict_types=1);

namespace App\Repositories\Vacation\Factory;

use App\DTO\Vacation\VacationDTO;
use App\Models\Vacation;

class VacationFactory
{
    public function makeDTOFromModel(Vacation $vacation): VacationDTO
    {
        return new VacationDTO(
            $vacation->user_id,
            $vacation->start_date,
            $vacation->end_date,
            $vacation->type
        );
    }
}
