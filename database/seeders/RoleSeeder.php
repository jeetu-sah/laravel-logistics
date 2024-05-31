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

                'name' => 'Author',
                'guard_name' => 'web',
                'slug' => 'author',
                'created_at' => date('Y-m-d'),
            ],
            [

                'name' => 'Editor',
                'guard_name' => 'web',
                'slug' => 'editor',
                'created_at' => date('Y-m-d'),
            ],
            [

                'name' => 'Reviewer',
                'guard_name' => 'web',
                'slug' => 'reviewer',
                'created_at' => date('Y-m-d'),
            ],
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
