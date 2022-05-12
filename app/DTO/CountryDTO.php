<?php

namespace App\DTO;

class CountryDTO
{
    private int $id;
    private string|null $country;

    /**
     * @param int $id
     * @param string|null $country
     */
    public function __construct(int $id, string|null $country)
    {
        $this->id = $id;
        $this->country = $country;
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
    public function getCountry(): string|null
    {
        return $this->country;
    }
}
