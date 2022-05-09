<?php

declare(strict_types=1);

namespace App\Factories;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class HomePageFactory
{
    /**
     * @param User $parameter
     * @return UserDTO
     */
    public function makeDTOFromModel(User $parameter): UserDTO
    {
        return new UserDTO(
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
     * @return UserDTO|array
     */
    public function makeDTOFromModelCollection(Collection $userParameters): UserDTO|array
    {
        $userParameterDTOs = [];

        foreach ($userParameters as $parameter) {
            $userParameterDTOs = $this->makeDTOFromModel($parameter);
        }
        return $userParameterDTOs;
    }
}
