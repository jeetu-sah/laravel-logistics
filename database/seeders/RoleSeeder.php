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
        $roles = [
            [

                'name' => 'Admin',
                'guard_name' => 'web',
                'slug' => 'admin',
                'created_at' => date('Y-m-d'),
            ],
            [

                'name' => 'Branchuser',
                'guard_name' => 'web',
                'slug' => 'branchuser',
                'created_at' => date('Y-m-d'),
            ],
            [

                'name' => 'Employee',
                'guard_name' => 'web',
                'slug' => 'employee',
                'created_at' => date('Y-m-d'),
            ]
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['slug' => $role['slug']], [
                'name' => $role['name'],
                'guard_name' => $role['guard_name'],
                'slug' => $role['slug'],
            ]);
        }
    }
}
