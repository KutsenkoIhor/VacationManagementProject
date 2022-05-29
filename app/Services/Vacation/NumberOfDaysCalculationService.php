<?php

declare(strict_types=1);


namespace App\Services\Vacation;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NumberOfDaysCalculationService
{
    public function getNumberOfVacationRequestDays(int $userId, Carbon $startDate, Carbon $endDate, string $type): int
    {
        //TODO inject CountryHoliday repository
        $holidays = DB::table('country_holidays')
            ->where('country_id', User::findOrFail($userId)->country_id)
            ->get();

        $countryHolidays = [];
        foreach ($holidays as $holiday) {
            $countryHolidays[] = (new Carbon($holiday->holiday_date))->startOfDay();
        }

        $number = 0;
        for ($i = $startDate; $i <= $endDate; $i->addDay()) {
            if ($i->isWeekend() || in_array($i->startOfDay(), $countryHolidays)) {
                continue;
            }
            $number++;
        }

        return $number;
    }
}
