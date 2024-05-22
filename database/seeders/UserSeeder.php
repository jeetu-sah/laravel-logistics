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
        $password = "@Admin@123#";
        User::create([
            'first_name' => 'Journal',
            'last_name' => 'Journal',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'mobile_verified_at' => now(),
            'mobile' => 8887603331,
            'user_type' => 'admin',
            'password' => Hash::make($password),
            'user_status' => 'active',
            'term_and_condition' => 1,
            'is_signed' => 1,
            'remember_token' => 222221,
        ]);
    }
}
