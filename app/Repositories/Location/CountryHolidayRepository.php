<?php

declare(strict_types=1);


namespace App\Repositories\Location;

use App\Models\CountryHoliday;
use App\Models\User;
use App\Repositories\Interfaces\CountryHolidayRepositoryInterface;
use Carbon\Carbon;

class CountryHolidayRepository implements CountryHolidayRepositoryInterface
{
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
