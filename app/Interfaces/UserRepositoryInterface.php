<?php

namespace App\Interfaces;

use App\DTO\UserDTO;
use App\Models\User;

interface UserRepositoryInterface
{
    public function getUserParameters (int $userId): UserDTO;
    public function searchEmail(string $email);
    public function createUser(string|null $firstName, string|null $lastName, string|null $userEmail, string|null $userAvatar, int|null $countryId, int|null $cityId);
    public function all(): object;
    public function getUserModelById (int $userId): User;

}
