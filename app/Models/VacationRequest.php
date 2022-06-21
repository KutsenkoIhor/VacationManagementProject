<?php

declare(strict_types = 1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property int $number_of_days
 * @property string $type
 * @property bool $is_approved
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property $user
 */

class VacationRequest extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const TYPE_VACATIONS = 'VACATIONS';
    public const TYPE_PERSONAL_DAYS = 'PERSONAL_DAYS';
    public const TYPE_SICK_DAYS = 'SICK_DAYS';


    protected $casts = [
        'start_date'    => 'datetime:Y-m-d',
        'end_date'      => 'datetime:Y-m-d',
        'is_approved'   => 'bool'
    ];

    protected $dates = ['deleted_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
