<?php

namespace App\DTO;

use Carbon\Carbon;

class PublicHolidayDTO
{
    public int $id;
    public string|null $title;
    public int|null $countryId;
    public $holidayDate;
    public string|null $countryTitle;

    /**
     * @param int $id
     * @param string|null $title
     * @param int|null $countryId
     * @param $holidayDate
     * @param string|null $countryTitle
     */
    public function __construct(int $id, string|null $title, int|null $countryId, $holidayDate, string|null $countryTitle)
    {
        $this->id = $id;
        $this->title = $title;
        $this->countryId = $countryId;
        $this->holidayDate = $holidayDate;
        $this->countryTitle = $countryTitle;
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

    public function getCountryTitle(): ?string
    {
        return $this->countryTitle;
    }
}
