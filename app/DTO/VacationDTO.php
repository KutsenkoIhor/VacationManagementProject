<?php

declare(strict_types=1);

namespace App\DTO;

use Carbon\Carbon;

class VacationDTO implements \JsonSerializable
{
    private int $id;
    private Carbon $startDate;
    private Carbon $endDate;
    private int $numberOfDays;
    private string $type;
    private Carbon $createdAt;
    private Carbon $updatedAt;
    private UserDTO $user;
    private VacationRequestDTO $vacationRequest;

    public function __construct(int $id, Carbon $startDate, Carbon $endDate, int $numberOfDays, string $type, Carbon $createdAt, Carbon $updatedAt, UserDTO $user, VacationRequestDTO $vacationRequest)
    {
        $this->id = $id;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->numberOfDays = $numberOfDays;
        $this->type = $type;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->user = $user;
        $this->vacationRequest = $vacationRequest;
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
            'id'               => $this->getId(),
            'start_date'       => $this->getStartDate(),
            'end_date'         => $this->getEndDate(),
            'number_of_days'   => $this->getNumberOfDays(),
            'type'             => $this->getType(),
            'created_at'       => $this->getCreatedAt(),
            'updated_at'       => $this->getUpdatedAt(),
            'user'             => $this->getUser(),
            'vacation_request' => $this->getVacationRequest()
        ];
    }
}
