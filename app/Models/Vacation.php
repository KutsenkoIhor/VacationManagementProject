<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property int $vacation_request_id
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property int $number_of_days
 * @property string $type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property $user
 */

class Vacation extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const TYPE_VACATIONS = 'VACATIONS';
    public const TYPE_PERSONAL_DAYS = 'PERSONAL_DAYS';
    public const TYPE_SICK_DAYS = 'SICK_DAYS';

    protected $casts = [
        'start_date'     => 'datetime:Y-m-d',
        'end_date'       => 'datetime:Y-m-d',
        'number_of_days' => 'int'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function vacation_request(): BelongsTo
    {
        return $this->belongsTo(VacationRequest::class, 'vacation_request_id', 'id');
    }
}
