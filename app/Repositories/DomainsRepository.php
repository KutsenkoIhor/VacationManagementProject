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

    public function all(): array
    {
        return $this->domainFactory->makeDTOFromModelCollection(Domain::all());
    }

    public function getById(int $id): DomainDTO
    {
        return $this->domainFactory->makeDTOFromModel(Domain::where('id', $id)->first());
    }

    public function store(string $name): void
    {
        Domain::create([
            'name' => $name,
        ]);
    }

    public function update(int $id, string $name): void
    {
        $domain = Domain::where('id', $id)->first();
        $domain->update([
            'name' => $name,
        ]);
    }

    public function delete(int $id): void
    {
        Domain::findOrFail($id)->delete();
    }

}
