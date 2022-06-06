<?php

namespace App\DTO;

class RoleDTO
{
    private int $id;
    private string|null $name;
    private int|null $vacationsDays;
    private int|null $personalDays;
    private int|null $sickDays;


    /**
     * @param int $id
     * @param string|null $name
     * @param int|null $vacationsDays
     * @param int|null $personalDays
     * @param int|null $sickDays
     */
    public function __construct(int $id, string|null $name, int|null $vacationsDays, int|null $personalDays, int|null $sickDays)
    {
        $this->id = $id;
        $this->name = $name;
        $this->vacationsDays = $vacationsDays;
        $this->personalDays = $personalDays;
        $this->sickDays = $sickDays;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): string|null
    {
        return $this->name;
    }

    public function getVacationsDays(): int|null
    {
        return $this->vacationsDays;
    }

    /**
     * @return int|null
     */
    public function getPersonalDays(): int|null
    {
        return $this->personalDays;
    }

    /**
     * @return int|null
     */
    public function getSickDays(): int|null
    {
        return $this->sickDays;
    }

}
