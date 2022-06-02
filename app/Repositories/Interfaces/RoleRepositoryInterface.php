<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface
{
    public function all();
    public function getRoleById(int $id);
    public function permissions();
    public function store($request);
    public function update(int $id, $request);
    public function delete(int $id);

}
