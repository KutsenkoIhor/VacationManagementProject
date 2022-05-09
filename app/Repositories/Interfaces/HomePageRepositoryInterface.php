<?php

namespace App\Repositories\Interfaces;

use App\DTO\UserDTO;

interface HomePageRepositoryInterface
{
    public function getUserParameters (int $userId): UserDTO;
}
