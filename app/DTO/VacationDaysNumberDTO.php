<?php

declare(strict_types=1);

namespace App\DTO;

class VacationDaysNumberDTO implements \JsonSerializable
{
    private int $numberOfDays;
    private int $numberOfDaysCurrentYear;
    private int $numberOfDaysNextYear;
    private int $numberOfDaysPreviousYear;

    public function __construct(
        int $numberOfDays,
        int $numberOfDaysCurrentYear,
        int $numberOfDaysNextYear,
        int $numberOfDaysPreviousYear
    )
    {
        $this->numberOfDays = $numberOfDays;
        $this->numberOfDaysCurrentYear = $numberOfDaysCurrentYear;
        $this->numberOfDaysNextYear = $numberOfDaysNextYear;
        $this->numberOfDaysPreviousYear = $numberOfDaysPreviousYear;
    }

    public function getNumberOfDays(): int
    {
        return $this->numberOfDays;
    }

    public function getNumberOfDaysCurrentYear(): int
    {
        return $this->numberOfDaysCurrentYear;
    }

    public function getNumberOfDaysNextYear(): int
    {
        return $this->numberOfDaysNextYear;
    }

    public function getNumberOfDaysPreviousYear(): int
    {
        return $this->numberOfDaysPreviousYear;
    }


    public function jsonSerialize(): array
    {
        return [
            'number_of_days'               => $this->getNumberOfDays(),
            'number_of_days_current_year'  => $this->getNumberOfDaysCurrentYear(),
            'number_of_days_next_year'     => $this->getNumberOfDaysNextYear(),
            'number_of_days_previous_year' => $this->getNumberOfDaysPreviousYear()
        ];
    }
}
