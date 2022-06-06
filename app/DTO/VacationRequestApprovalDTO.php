<?php

declare(strict_types=1);

namespace App\DTO;

use Carbon\Carbon;

class VacationRequestApprovalDTO implements \JsonSerializable
{
    private int $id;
    private bool $isApproved;
    private Carbon $createdAt;
    private Carbon $updatedAt;
    private UserDTO $user;
    private VacationRequestDTO $vacationRequest;

    public function __construct(
        int $id,
        bool $isApproved,
        Carbon $createdAt,
        Carbon $updatedAt,
        UserDTO $user,
        VacationRequestDTO $vacationRequest
    ) {
        $this->id = $id;
        $this->isApproved = $isApproved;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->user = $user;
        $this->vacationRequest = $vacationRequest;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function isApproved(): bool
    {
        return $this->isApproved;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt;
    }

    public function getUser(): UserDTO
    {
        return $this->user;
    }

    public function getVacationRequest(): VacationRequestDTO
    {
        return $this->vacationRequest;
    }

    public function jsonSerialize(): array
    {
        return [
            'id'                  => $this->getId(),
            'is_approved'         => $this->isApproved(),
            'created_at'          => $this->getCreatedAt(),
            'updated_at'          => $this->getUpdatedAt(),
            'user'                => $this->getUser(),
            'vacation_request'    => $this->getVacationRequest()
        ];
    }
}
