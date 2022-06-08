<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $vacations
 * @property int $personal_days
 * @property int $sick_days
 */
class VacationDaysLeft extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vacation_days_left';

    protected $fillable = [
        'user_id',
        'vacations',
        'personal_days',
        'sick_days',
    ];

    public $timestamps = false;

    protected $primaryKey = 'id';

}
