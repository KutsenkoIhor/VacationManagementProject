<?php

namespace App\Factories;

use App\DTO\PublicHolidayDTO;
use App\Models\CountryHoliday;
use Illuminate\Database\Eloquent\Collection;

class PublicHolidayFactory
{
    /**
     * @param CountryHoliday $parameter
     * @return PublicHolidayDTO
     */
    public function makeDTOFromModel(CountryHoliday $parameter): PublicHolidayDTO
    {
        return new PublicHolidayDTO(
            $parameter->id,
            $parameter->title,
            $parameter->country_id,
            $parameter->holiday_date,
            $parameter->country->title,
        );

    }

    /**
     * @param Collection $publicHolidayParameters
     * @return array
     */
    public function makeDTOFromModelCollection(Collection $publicHolidayParameters): array
    {
        $publicHolidayParameterDTOs = [];
        foreach ($publicHolidayParameters as $parameter) {
            $publicHolidayParameterDTOs[] = $this->makeDTOFromModel($parameter);
        }
        return $publicHolidayParameterDTOs;
    }

}
