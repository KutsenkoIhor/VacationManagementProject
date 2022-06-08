<?php

namespace App\Repositories\Interfaces\ListEmployees;

use App\Models\User;

interface ListEmployeesUserRepositoryInterface
{
    public function updateOrCreate(string|null $firstName, string|null $lastName, string|null $userEmail, int|null $countryId, int|null $cityId);
    public function all(): object;
    public function getUserModelById (int $userId): User;
    public function elasticsearchPagination($arrIdUserElasticsearch): object;
    public function allPagination(array $role, string|int|null $countryId, string|int|null $cityId): object;
}
