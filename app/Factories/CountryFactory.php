<?php

namespace App\Factories;

use App\DTO\CountryDTO;
use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class CountryFactory
{

    /**
     * @param Country $parameter
     * @return CountryDTO
     */
    public function makeDTOFromModel(Country $parameter): CountryDTO
    {
        return new CountryDTO(
            $parameter->id,
            $parameter->title,
        );

    }

    /**
     * @param Collection $countryParameters
     * @return array
     */
    public function makeDTOFromModelCollection(Collection $countryParameters): array
    {
        $countryParameterDTOs = [];
        foreach ($countryParameters as $parameter) {
            $countryParameterDTOs[] = $this->makeDTOFromModel($parameter);
        }
        return $countryParameterDTOs;
    }

}
