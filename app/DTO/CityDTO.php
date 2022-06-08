<?php

namespace App\DTO;

class CityDTO
{
    public int $id;
    public int|null $countryId;
    public string|null $title;
    public string|null $countryTitle;

    /**
     * @param int $id
     * @param int|null $countryId
     * @param string|null $title
     * @param string|null $countryTitle
     */
    public function __construct(int $id, int|null $countryId, string|null $title, string|null $countryTitle)
    {
        $this->id = $id;
        $this->countryId = $countryId;
        $this->title = $title;
        $this->countryTitle = $countryTitle;
    }

    /**
     * @return string|null
     */
    public function getCountryTitle(): ?string
    {
        return $this->countryTitle;
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
    public function getCountryId (): string|null
    {
        return $this->countryId;
    }

    /**
     * @return string|null
     */
    public function getTitle(): string|null
    {
        return $this->title;
    }
}
