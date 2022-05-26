<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property int|null $country_id
 * @property int|null $city_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $email
 * @property string|null $google_avatar
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;



    /**
     * The attributes that are mass assignable.
     *
     *
     * @var array<int, string>
     *
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'google_avatar',
        'email_verified_at',
        'city_id',
        'country_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function vacationDaysLeft(): object
    {
        return $this->hasOne(VacationDaysLeft::class);
    }

    public function vacationDaysPerYear(): object
    {
        return $this->hasOne(VacationDaysPerYear::class);
    }

    public function vacations(): object
    {
        return $this->hasOne(Vacation::class);
    }

    public function cityHr(): object
    {
        return $this->hasOne(CityHr::class, 'hr_id');
    }

    public function employeeHrForeignKeyEmployee(): object
    {
        return $this->hasOne(EmployeeHr::class, 'employee_id');
    }

    public function employeeHrForeignKeyHr(): object
    {
        return $this->hasOne(EmployeeHr::class, 'hr_id');
    }

    public function employeePmForeignKeyEmployee(): object
    {
        return $this->hasOne(EmployeePm::class, 'employee_id');
    }

    public function employeePmForeignKeyPm(): object
    {
        return $this->hasOne(EmployeePm::class, 'pm_id');
    }
}
