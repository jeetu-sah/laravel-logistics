<?php 

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Branch;

class TranshipmentFactory extends Factory
{
    public function definition()
    {
        return [
            'booking_id'       => Booking::factory(), 
            'from_transhipment'=> Branch::inRandomOrder()->value('id') ?? 1,
            'sequence_no'      => 1, // overridden in seeder
            'received_at'      => $this->faker->optional()->dateTimeBetween('-1 week', 'now'),
            'dispatched_at'    => $this->faker->optional()->dateTimeBetween('now', '+1 week'),
            'status'           => $this->faker->randomElement(['pending','received','dispatched']),
            'type'             => $this->faker->randomElement(['road','rail','air']),
        ];
    }
}

?>
