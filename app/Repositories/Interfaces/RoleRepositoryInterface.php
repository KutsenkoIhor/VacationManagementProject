<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface
{
    public function all(): object;
    public function getRoleById(int $id): object;
    public function permissions(): object;
    public function store($request);
    public function update(int $id, $request);
    public function delete(int $id);
}
