<?php

namespace App\Interfaces;

use App\DTO\UserDTO;

interface UserRepositoryInterface
{
    public function getUserParameters (int $userId): UserDTO;
    public function searchEmail(string $email);
    public function createUser(string|null $firstName, string|null $lastName, string|null $userEmail, string|null $userAvatar, int|null $countryId, int|null $cityId);

}
