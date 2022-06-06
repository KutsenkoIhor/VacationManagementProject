<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\DomainDTO;
use App\Factories\DomainFactory;
use App\Models\Domain;
use App\Repositories\Interfaces\DomainsRepositoryInterface;


class DomainsRepository implements DomainsRepositoryInterface
{
    private DomainFactory $domainFactory;

    public function __construct(DomainFactory $domainFactory)
    {
        $this->domainFactory = $domainFactory;
    }

    public function all()
    {
        return $this->domainFactory->makeDTOFromModelCollection(Domain::all());
    }

    public function getById(int $id): DomainDTO
    {
        return $this->domainFactory->makeDTOFromModel(Domain::where('id', $id)->first());
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
