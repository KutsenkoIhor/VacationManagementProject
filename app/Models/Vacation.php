<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;;

/**
 * @property int $id
 * @property int $user_id
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property int $number_of_days
 * @property string $type
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */

class Vacation extends Model
{
    use HasFactory;

    public const STATUS_NEW = 'NEW';
    public const STATUS_APPROVED = 'APPROVED';
    public const STATUS_DENIED = 'DENIED';

    public const TYPE_VACATIONS = 'VACATIONS';
    public const TYPE_PERSONAL_DAYS = 'PERSONAL_DAYS';
    public const TYPE_SICK_DAYS = 'SICK_DAYS';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
//        'start_date'    => 'datetime:'.DATE_W3C,
//        'end_date'      => 'datetime:'.DATE_W3C,
        'start_date'    => 'datetime:Y-m-d',
        'end_date'      => 'datetime:Y-m-d',
    ];
}
