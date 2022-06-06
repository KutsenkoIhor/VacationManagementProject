<?php

namespace App\Factories;

use App\DTO\DomainDTO;
use App\Models\Domain;
use Illuminate\Database\Eloquent\Collection;

class DomainFactory
{

    /**
     * @param Domain $parameter
     * @return DomainDTO
     */
    public function makeDTOFromModel(Domain $parameter): DomainDTO
    {
        return new DomainDTO(
            $parameter->id,
            $parameter->name,
        );

    }

    /**
     * @param Collection $domainParameters
     * @return array
     */
    public function makeDTOFromModelCollection(Collection $domainParameters): array
    {
        $domainParameterDTOs = [];
        foreach ($domainParameters as $parameter) {
            $domainParameterDTOs[] = $this->makeDTOFromModel($parameter);
        }
        return $domainParameterDTOs;
    }

}
