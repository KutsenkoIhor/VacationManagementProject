<?php

declare(strict_types=1);

namespace App\DTO\Vacation;

use Carbon\Carbon;

class VacationDTO implements \JsonSerializable
{
    private int $id;
    private int $userId;
    private Carbon $startDate;
    private Carbon $endDate;
    private string $type;

    public function __construct(int $id, int $userId, Carbon $startDate, Carbon $endDate, string $type)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->type = $type;
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

    public function jsonSerialize(): array
    {
        return [
            'id'         => $this->getId(),
            'user_id'    => $this->getUserId(),
            'start_date' => $this->getStartDate(),
            'end_date'   => $this->getEndDate(),
            'type'       => $this->getType()
        ];
    }
}
