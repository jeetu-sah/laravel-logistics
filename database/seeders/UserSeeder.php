<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminPassword = "Admin@123#";
        $branchPassword = "Branch@123#";
        $users = [
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'mobile_verified_at' => now(),
                'mobile' => 88876033315,
                'user_type' => 'admin',
                'password' => Hash::make($adminPassword),
                'user_status' => 'active',
                'term_and_condition' => 1,
                'is_signed' => 1,
                'remember_token' => 222221,
            ],
            [
                'first_name' => 'Vikas Logistics branch',
                'last_name' => 'Journal',
                'email' => 'branch@gmail.com',
                'email_verified_at' => now(),
                'mobile_verified_at' => now(),
                'mobile' => 88876033315,
                'user_type' => 'branch-user',
                'password' => Hash::make($branchPassword),
                'user_status' => 'active',
                'term_and_condition' => 1,
                'is_signed' => 1,
                'remember_token' => 222221,
            ],
        ];

        foreach ($users as $user) {
            $user = User::updateOrCreate(['email' => $user['email']], $user);   
        }
    }
}
