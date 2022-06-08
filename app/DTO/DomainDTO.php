<?php

namespace App\DTO;

class DomainDTO
{
    public int $id;
    public string|null $name;

    /**
     * @param int $id
     * @param string|null $name
     */
    public function __construct(int $id, string|null $name)
    {
        $this->id = $id;
        $this->name = $name;
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
}
