<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Factories\PublicHolidayFactory;
use App\Models\CountryHoliday;
use App\Models\User;
use App\Repositories\Interfaces\CountryHolidayRepositoryInterface;
use Carbon\Carbon;

class CountryHolidayRepository implements CountryHolidayRepositoryInterface
{
    private PublicHolidayFactory $holidayFactory;

    public function __construct(PublicHolidayFactory $holidayFactory)
    {
        $this->holidayFactory = $holidayFactory;
    }

    public function all(): array
    {
        return $this->holidayFactory->makeDTOFromModelCollection(CountryHoliday::all());
    }

    public function getById(int $id): object
    {
        return CountryHoliday::where('id', $id)->first();
    }

    public function store(string $title, int $country_id, $date): void
    {
            CountryHoliday::create([
                'title' => $title,
                'country_id' => $country_id,
                'holiday_date' => $date,
            ]);

    }

    public function update(int $id, string $title, int $country_id, $date): void
    {
        $holiday = CountryHoliday::where('id', $id)->first();
        $holiday->update([
            'title' => $title,
            'country_id' => $country_id,
            'holiday_date' => $date,
        ]);
    }

    public function delete(int $id)
    {
        CountryHoliday::findOrFail($id)->delete();
    }

    public function getCountryHolidayDates(int $userId): array
    {
        $holidays = CountryHoliday::where('country_id', User::findOrFail($userId)->country_id)->get();

        $countryHolidayDates = [];
        foreach ($holidays as $holiday) {
            $countryHolidayDates[] = (new Carbon($holiday->holiday_date))->startOfDay();
        }

        return $countryHolidayDates;
    }

}
