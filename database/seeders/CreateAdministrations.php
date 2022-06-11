<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VacationDaysPerYear;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CreateAdministrations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rootAdministrations = [
            'kutsenko3igor@gmail.com' => ['firstName' => 'Ihor', 'lastName' => 'Kutsenko'],
            'ihor.kutsenko@quantox.com' => ['firstName' => 'Ihor', 'lastName' => 'Quantox'],
            'valeriia.skliarenko@quantox.com' => ['firstName' => 'Valeriia', 'lastName' => 'Skliarenko']
        ];

        foreach ($rootAdministrations as $email => $arrDataUsers) {
            $modelUser = $this->createUser($email, $arrDataUsers['firstName'], $arrDataUsers['lastName']);
            $userId = $modelUser->id;
            $this->setRole($modelUser);
            $this->setPermission($modelUser);
            $this->setVacations($userId);
        }
    }

    private function createUser(string $email, string $firstName, string $lastName): User
    {
        return User::create([
            'email' => $email,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    private function setRole(User $modelUser):void
    {
        $modelUser->assignRole('System Admin', 'Employee', 'PM', 'HR');
    }

    private function setPermission(User $modelUser):void
    {
//        $role = Role::findByName('System Admin');
//        $role->givePermissionTo(
//            'show countries',
//            'add countries',
//            'edit countries',
//            'delete countries',
//            'show cities',
//            'add cities',
//            'edit cities',
//            'delete cities',
//            'show users',
//            'add users',
//            'edit users',
//            'delete users'
//        );
        $modelUser->givePermissionTo(
            'show countries',
            'add countries',
            'edit countries',
            'delete countries',
            'show cities',
            'add cities',
            'edit cities',
            'delete cities',
            'show users',
            'add users',
            'edit users',
            'delete users'
        );
    }


     private function setVacations(int $userId): void
     {
         VacationDaysPerYear::create([
             'user_id' => $userId,
             'vacations' => 10,
             'personal_days' => 20,
             'sick_days' => 30,
         ]);
     }
}
