<?php

namespace App\Factories;

use App\DTO\RoleDTO;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleFactory
{
    public function makeDTOFromModel($parameter): RoleDTO
    {
        return new RoleDTO(
            $parameter->id,
            $parameter->name,
            $parameter->vacations,
            $parameter->personal_days,
            $parameter->sick_days,
        );

    }

    public function makeDTOFromModelCollection(Collection $roleParameters): array
    {
        $roleParameterDTOs = [];
        foreach ($roleParameters as $parameter) {
            $roleParameterDTOs[] = $this->makeDTOFromModel($parameter);
        }

        return $roleParameterDTOs;
    }
}
