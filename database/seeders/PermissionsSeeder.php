<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        //Countries
        Permission::create(['name' => 'show countries']);
        Permission::create(['name' => 'add countries']);
        Permission::create(['name' => 'edit countries']);
        Permission::create(['name' => 'delete countries']);

        //Cities
        Permission::create(['name' => 'show cities']);
        Permission::create(['name' => 'add cities']);
        Permission::create(['name' => 'edit cities']);
        Permission::create(['name' => 'delete cities']);

        //Users
        Permission::create(['name' => 'show users']);
        Permission::create(['name' => 'add users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
    }
}
