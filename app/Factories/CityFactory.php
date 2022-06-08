<?php

namespace App\Factories;

use App\DTO\CityDTO;
use App\Models\City;
use Illuminate\Database\Eloquent\Collection;

class CityFactory
{
    /**
     * @param City $parameter
     * @return CityDTO
     */
    public function makeDTOFromModel(City $parameter): CityDTO
    {
        return new CityDTO(
            $parameter->id,
            $parameter->country_id,
            $parameter->title,
            $parameter->country->title,
        );
    }

    public function makeDTOFromModelCollection(Collection $cityParameters): array
    {
        $cityParameterDTOs = [];
        foreach ($cityParameters as $parameter) {
            $cityParameterDTOs[] = $this->makeDTOFromModel($parameter);
        }
        return $cityParameterDTOs;
    }


}
