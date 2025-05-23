<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

class BranchFactory extends Factory
{
    protected $model = Branch::class;

    public function definition(): array
    {
        return [
            'branch_name'   => $this->faker->company,
            'branch_code'   => strtoupper($this->faker->bothify('BR###')),
            'owner_name'    => $this->faker->name,
            'contact'       => $this->faker->numerify('98########'),
            'gst'           => $this->faker->regexify('[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}'),
            'country_name'  => null,
            'state_name'    => null,
            'city_name'     => null,
            'address1'      => $this->faker->streetAddress,
            'address2'      => $this->faker->secondaryAddress,
            'user_status'   => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
