<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Domain;
use App\Repositories\Interfaces\DomainsRepositoryInterface;


class DomainsRepository implements DomainsRepositoryInterface
{
    public function all(): object
    {
        return Domain::all();
    }

    public function getById(int $id): object
    {
        return Domain::where('id', $id)->first();
    }

    public function store($request): void
    {
        Domain::create([
            'name' => $request->name,
        ]);
    }

    public function update(int $id, $request): void
    {
        $domain = Domain::where('id', $id)->first();
        $domain->update([
            'name' => $request->name,
        ]);
    }

    public function delete(int $id)
    {
        Domain::findOrFail($id)->delete();
    }

}
