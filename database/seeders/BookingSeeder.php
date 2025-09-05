<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Transhipment;


class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::factory()
            ->count(500)
            ->create()
            ->each(function ($booking) {
                // number of transhipments per booking
                $transhipCount = rand(1, 3);

                for ($i = 1; $i <= $transhipCount; $i++) {
                    Transhipment::factory()->create([
                        'booking_id'    => $booking->id,
                        'sequence_no'   => $i,
                        'from_transhipment'=> \App\Models\Branch::inRandomOrder()->value('id'),
                    ]);
                }
            });
    }
}
