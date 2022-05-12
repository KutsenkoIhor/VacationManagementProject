<?php

declare(strict_types=1);

namespace App\Interfaces;

interface RoleRepositoryInterface
{
    public function all();
    public function getRoleById($id);
    public function permissions();
    public function store($request);
    public function update($id, $request);
    public function delete($id);

}
