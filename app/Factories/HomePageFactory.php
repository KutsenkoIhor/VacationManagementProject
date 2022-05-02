<?php

declare(strict_types=1);

namespace App\Factories;

use App\DTO\UsersDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class HomePageFactory
{
    /**
     * @param User $parameter
     * @return UsersDTO
     */
    public function makeDTOFromModel(User $parameter): UsersDTO
    {
        return new UsersDTO(
            $parameter->id,
            $parameter->country_id,
            $parameter->city_id,
            $parameter->first_name,
            $parameter->last_name,
            $parameter->email,
            $parameter->google_avatar,
        );
    }

    /**
     * @param Collection $userParameters
     * @return UsersDTO|array
     */
    public function makeDTOFromModelCollection(Collection $userParameters): UsersDTO|array
    {
        $userParameterDTOs = [];

        foreach ($userParameters as $parameter) {
            $userParameterDTOs = $this->makeDTOFromModel($parameter);
        }
        return $userParameterDTOs;
    }
}
