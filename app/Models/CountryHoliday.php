<?php

declare(strict_types=1);


namespace App\Models;

/**
 * @property int $id
 * @property int $country_id
 * @property Carbon $holiday_date
 * @property Country $country;
 */

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CountryHoliday extends Model
{
    use HasFactory;

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
