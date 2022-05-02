<?php

namespace App\Repositories\Interfaces;

use App\DTO\UsersDTO;

interface HomePageRepositoryInterface
{
    public function getUserParameters (int $userId): UsersDTO;
}
