<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Branch;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'mobile'     => $this->faker->numerify('98########'),
            'email'      => $this->faker->unique()->safeEmail,
            'degree'     => $this->faker->randomElement(['B.Sc', 'M.Sc', 'PhD']),
            'institution' => $this->faker->company,
            'position'   => $this->faker->jobTitle,
            'department' => $this->faker->word,
            'reason'     => $this->faker->sentence,
            'user_type'  => User::EMPLOYEE,
            'password'   => Hash::make('password'), // or bcrypt('password')
            'user_status' => $this->faker->randomElement(['active', 'inactive']),
            'term_and_condition' => true,
            'is_signed' => $this->faker->boolean,
            'userId'    => null, // can be assigned explicitly in test or seeder
            'branch_user_id' => Branch::factory()
        ];
    }


    public function employee(): static
    {
        return $this->state(fn(array $attributes) => [
            'user_type' => User::EMPLOYEE,
        ]);
    }

    public function branchUser(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_type' => User::BRANCH_USER,
        ]);
    }
}
