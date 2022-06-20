<?php

namespace App\DTO;

class EmployeePmDTO
{
    public int|null $idPm;
    public int|null $idEmployee;


    /**
     * @param int|null $idPm
     * @param int|null $idEmployee
     */
    public function __construct(int|null $idPm, int|null $idEmployee)
    {
        $this->idPm = $idPm;
        $this->idEmployee = $idEmployee;
    }

    /**
     * @return int|null
     */
    public function getIdPm(): int|null
    {
        return $this->idPm;
    }

    /**
     * @return int|null
     */
    public function getIdEmployee(): int|null
    {
        return $this->idEmployee;
    }
}
