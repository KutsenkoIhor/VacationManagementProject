<?php

namespace App\Factories;

use App\DTO\EmployeePmDTO;
use App\Models\EmployeePm;
use Illuminate\Database\Eloquent\Collection;

class EmployeePmFactory
{
    /**
     * @param EmployeePm $parameter
     * @return EmployeePmDTO
     */
    public function makeDTOFromModel(EmployeePm $parameter): EmployeePmDTO
    {
        return new EmployeePmDTO(
            $parameter->pm_id,
            $parameter->employee_id,
        );
    }

    /**
     * @param Collection $cityParameters
     * @return array
     */
    public function makeDTOFromModelCollection(Collection $cityParameters): array
    {
        $cityParameterDTOs = [];
        foreach ($cityParameters as $parameter) {
            $cityParameterDTOs[] = $this->makeDTOFromModel($parameter);
        }
        return $cityParameterDTOs;
    }
}
