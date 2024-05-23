<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $password = "@Admin@123#";
        Role::create([
            'name' => 'Admin',
            'guard_name' => 'web',
            'slug' => 'admin',
            'created_at' => date('Y-m-d'),
        ]);
    }
}
