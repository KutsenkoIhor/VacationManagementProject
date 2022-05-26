<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 1000; $i++) {
            DB::table('users')->insert([
                'first_name' => Str::random(7),
                'last_name' => Str::random(10),
                'email' => Str::random(5).'@gmail.com',
            ]);
        }
    }
}
