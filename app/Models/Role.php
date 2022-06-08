<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $name
 * @property int|null $vacations
 * @property int|null $personal_days
 * @property int|null $sick_days
 */
class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     *
     * @var array<int, string>
     *
     */
    protected $fillable = [
        'id',
        'name',
        'vacations',
        'personal_days',
        'sick_days',
    ];
}
