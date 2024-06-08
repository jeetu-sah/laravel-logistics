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
        
        $user = User::create([
            'first_name' => 'Journal',
            'last_name' => 'Journal',
            'email' => 'author@gmail.com',
            'email_verified_at' => now(),
            'mobile_verified_at' => now(),
            'mobile' => 88876033315,
            'user_type' => 'author',
            'password' => Hash::make($password),
            'user_status' => 'active',
            'term_and_condition' => 1,
            'is_signed' => 1,
            'remember_token' => 222221,
        ]);

        if($user != NULL) {
            $user->assignRole('author'); 
            $user->assignRole('reviewer'); 
        }
    }
}
