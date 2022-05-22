<?php

declare(strict_types=1);

namespace App\DTO;

class VacationApprovalDTO implements \JsonSerializable
{
    private int $id;
    private int $vacationId;
    private int $userId;
    private string $status;
    private UserDTO $user;
    private VacationDTO $vacation;

    public function __construct(
        int $id,
        int $vacationId,
        int $userId,
        string $status,
        UserDTO $user,
        VacationDTO $vacation
    ) {
        $this->id = $id;
        $this->vacationId = $vacationId;
        $this->userId = $userId;
        $this->status = $status;
        $this->user = $user;
        $this->vacation = $vacation;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getVacationId(): int
    {
        return $this->vacationId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getUser(): UserDTO
    {
        return $this->user;
    }

    public function getVacation(): VacationDTO
    {
        return $this->vacation;
    }

    public function jsonSerialize(): array
    {
        return [
            'id'          => $this->getId(),
            'vacation_id' => $this->getVacationId(),
            'user_id'     => $this->getUserId(),
            'status'      => $this->getStatus(),
            'user'        => $this->getUser(),
            'vacation'    => $this->getVacation()
        ];
    }
}
