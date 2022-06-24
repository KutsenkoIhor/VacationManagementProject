<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface DomainsRepositoryInterface
{
    public function all();
    public function getById(int $id);
    public function store(string $name);
    public function update(int $id, string $name);
    public function delete(int $id);
}
