<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface CountriesRepositoryInterface
{
    public function all();
    public function getById($id);
    public function add($request);
    public function update(int $id, $request);
    public function delete($id);
}
