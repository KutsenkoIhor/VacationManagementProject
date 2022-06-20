<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|null $pm_id
 * @property int|null $employee_id
 */
class EmployeePm extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'pm_id',
        'employee_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employees_pms';
}
