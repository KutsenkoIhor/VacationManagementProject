<?php

declare(strict_types=1);

namespace App\DTO;

use Carbon\Carbon;

class VacationDTO implements \JsonSerializable
{
    private int $id;
    private int $userId;
    private Carbon $startDate;
    private Carbon $endDate;
    private string $type;
    private string $status;
    private UserDTO $user;

    public function __construct(
        int $id,
        int $userId,
        Carbon $startDate,
        Carbon $endDate,
        string $type,
        string $status,
        UserDTO $user
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->type = $type;
        $this->status = $status;
        $this->user = $user;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getStartDate(): Carbon
    {
        return $this->startDate;
    }

    public function getEndDate(): Carbon
    {
        return $this->endDate;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getUser(): UserDTO
    {
        return $this->user;
    }

    public function jsonSerialize(): array
    {
        return [
            'id'         => $this->getId(),
            'user_id'    => $this->getUserId(),
            'start_date' => $this->getStartDate(),
            'end_date'   => $this->getEndDate(),
            'type'       => $this->getType(),
            'status'     => $this->getStatus(),
            'user'       => $this->getUser()
        ];
    }
}
