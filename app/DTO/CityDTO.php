<?php

namespace App\DTO;

class CityDTO
{
    private int $id;
    private int|null $countryId;
    private string|null $city;

    /**
     * @param int $id
     * @param int|null $countryId
     * @param string|null $city
     */
    public function __construct(int $id, int|null $countryId, string|null $city)
    {
        $this->id = $id;
        $this->countryId = $countryId;
        $this->city = $city;
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
    public function getCountryId(): string|null
    {
        return $this->countryId;
    }

    /**
     * @return string|null
     */
    public function getCity(): string|null
    {
        return $this->city;
    }
}
