<?php

namespace App\DTO;

class CountryDTO
{
    public int $id;
    public string|null $title;

    /**
     * @param int $id
     * @param string|null $title
     */
    public function __construct(int $id, string|null $title)
    {
        $this->id = $id;
        $this->title = $title;
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
    public function getTitle(): string|null
    {
        return $this->title;
    }
}
