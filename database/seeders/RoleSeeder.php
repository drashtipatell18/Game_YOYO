<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role; // or your own Role model

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'customer']);
    }
}
