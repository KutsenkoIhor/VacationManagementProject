<?php

declare(strict_types=1);

namespace App\Services\Settings;

use App\Repositories\Interfaces\DomainsRepositoryInterface;
use App\Http\Requests\AddDomainRequest;
use App\Http\Requests\EditDomainRequest;

class DomainsService
{
    private DomainsRepositoryInterface $domainsRepository;

    public function __construct(DomainsRepositoryInterface $domainsRepository)
    {
        $this->domainsRepository = $domainsRepository;
    }

    public function all(): array
    {
        return $this->domainsRepository->all();
    }

    public function store(AddDomainRequest $request): void
    {
        $name = $request->name;

        $this->domainsRepository->store($name);
    }

    public function getById(int $id): object
    {
        return $this->domainsRepository->getById($id);
    }

    public function update(int $id, EditDomainRequest $request): void
    {
        $name = $request->name;

        $this->domainsRepository->update($id, $name);
    }

    public function delete(int $id): void
    {
         $this->domainsRepository->delete($id);
    }
}
