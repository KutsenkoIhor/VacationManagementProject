<?php

declare(strict_types=1);


namespace App\DTO;

use Carbon\Carbon;

class VacationRequestDTO
{
    private int $id;
    private Carbon $startDate;
    private Carbon $endDate;
    private int $numberOfDays;
    private string $type;
    private ?bool $isApproved;
    private Carbon $createdAt;
    private Carbon $updatedAt;
    private UserDTO $user;

    public function __construct(
        int $id,
        Carbon $startDate,
        Carbon $endDate,
        int $numberOfDays,
        string $type,
        ?bool $isApproved,
        Carbon $createdAt,
        Carbon $updatedAt,
        UserDTO $user
    ) {
        $this->id = $id;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->numberOfDays = $numberOfDays;
        $this->type = $type;
        $this->isApproved = $isApproved;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->user = $user;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStartDate(): Carbon
    {
        return $this->startDate;
    }

    public function getEndDate(): Carbon
    {
        return $this->endDate;
    }

    public function getNumberOfDays(): int
    {
        return $this->numberOfDays;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function IsApproved(): ?bool
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

    public function jsonSerialize(): array
    {
        return [
            'id'             => $this->getId(),
            'start_date'     => $this->getStartDate(),
            'end_date'       => $this->getEndDate(),
            'number_of_days' => $this->getNumberOfDays(),
            'type'           => $this->getType(),
            'is_approved'    => $this->isApproved(),
            'created_at'     => $this->getCreatedAt(),
            'updated_at'     => $this->getUpdatedAt(),
            'user'           => $this->getUser()
        ];
    }


}
