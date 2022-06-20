<?php

namespace App\Repositories\Interfaces;

use App\DTO\UserDTO;
use App\Models\User;

interface UserRepositoryInterface
{
    public function all(): object;
    public function allPagination(array $role, string|int|null $countryId, string|int|null $cityId): object;
    public function elasticsearchPagination($arrIdUserElasticsearch): object;
    public function getUserParameters (int $userId): UserDTO;
    public function searchEmail(string $email): object|null;
    public function createUser(string|null $firstName, string|null $lastName, string|null $userEmail, string|null $userAvatar, int|null $countryId, int|null $cityId): object;
    public function updateOrCreate(string|null $firstName, string|null $lastName, string|null $userEmail, int|null $countryId, int|null $cityId);
    public function getUserModelById (int $userId): User;
    public function getUserModelsWhereIdInArr($arrIdUser): object;
    public function getUserIdByEmail(string $email): int;
}
