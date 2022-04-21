<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superAdmin@gmail.com',
            'country_id' => 1,
            'city_id' => 2
        ]);
    }
}
