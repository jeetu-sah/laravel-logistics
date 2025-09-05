<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $freight   = $this->faker->randomFloat(2, 500, 5000);
        $wbc       = $this->faker->randomFloat(2, 10, 200);
        $handling  = $this->faker->randomFloat(2, 10, 200);
        $fov       = $this->faker->randomFloat(2, 10, 200);
        $fuel      = $this->faker->randomFloat(2, 50, 500);
        $tranship1 = $this->faker->randomFloat(2, 10, 200);
        $tranship2 = $this->faker->randomFloat(2, 10, 200);
        $tranship3 = $this->faker->randomFloat(2, 10, 200);
        $pickup    = $this->faker->randomFloat(2, 10, 200);
        $hamali    = $this->faker->randomFloat(2, 10, 200);
        $bilti     = $this->faker->randomFloat(2, 10, 200);
        $discount  = $this->faker->randomFloat(2, 0, 500);
        $company   = $this->faker->randomFloat(2, 0, 500);
        $misc      = $this->faker->randomFloat(2, 0, 300);

        // subtotal
        $subTotal = $freight + $wbc + $handling + $fov + $fuel
                  + $tranship1 + $tranship2 + $tranship3
                  + $pickup + $hamali + $bilti + $company - $discount;

        // taxes
        $cgst = round($subTotal * 0.09, 2);
        $sgst = round($subTotal * 0.09, 2);
        $igst = 0; // you can randomize if needed

        $grandTotal  = $subTotal + $cgst + $sgst + $igst;
        $grandAmount = $grandTotal + $misc;

        return [
            'bilti_number'           => $this->faker->unique()->bothify('NB-#####'),
            'status'                 => $this->faker->randomElement(['1','2','3','4']),
            'booking_type'           => $this->faker->randomElement(['Paid', 'Topay', 'Toclient']),
            'booking_date'           => $this->faker->date(),
            'consignor_branch_id'    => $this->faker->numberBetween(1, 10),
            'consignee_branch_id'    => $this->faker->numberBetween(1, 10),
            'no_of_artical'          => $this->faker->numberBetween(1, 20),
            'good_of_value'          => $this->faker->randomFloat(2, 500, 50000),
            'consignor_name'         => $this->faker->name(),
            'consignor_address'      => $this->faker->address(),
            'consignor_phone_number' => $this->faker->phoneNumber(),
            'consignor_gst_number'   => strtoupper($this->faker->bothify('??######??')),
            'consignor_email'        => $this->faker->safeEmail(),
            'invoice_number'         => $this->faker->numerify('INV-#####'),
            'eway_bill_number'       => $this->faker->numerify('EWB-######'),
            'mark'                   => $this->faker->word(),
            'remark'                 => $this->faker->sentence(),
            'photo_id'               => $this->faker->uuid(),
            'parcel_image'           => $this->faker->imageUrl(640, 480, 'transport'),
            'distance'               => $this->faker->randomFloat(2, 1, 2000),
            'freight_amount'         => $freight,
            'wbc_charges'            => $wbc,
            'handling_charges'       => $handling,
            'fov_amount'             => $fov,
            'fuel_amount'            => $fuel,
            'transhipmen_one_amount' => $tranship1,
            'transhipmen_two_amount' => $tranship2,
            'transhipment_three_amount' => $tranship3,
            'pickup_charges'         => $pickup,
            'hamali_Charges'         => $hamali,
            'bilti_Charges'          => $bilti,
            'discount'               => $discount,
            'compney_charges'        => $company,
            'sub_total'              => $subTotal,
            'cgst'                   => $cgst,
            'sgst'                   => $sgst,
            'igst'                   => $igst,
            'grand_total'            => $grandTotal,
            'misc_charge_amount'     => $misc,
            'grand_total_amount'     => $grandAmount,
            'actual_weight'          => $this->faker->randomFloat(2, 5, 200),
            'cantain'                => $this->faker->word(),
            'aadhar_card'            => $this->faker->numerify('############'),
            'manual_bilty_number'    => $this->faker->bothify('MB-#####'),
            'client_id'              => $this->faker->numberBetween(1, 20),
            'client_to_id'           => $this->faker->numberBetween(1, 20),
            'consignee_name'         => $this->faker->name(),
            'consignee_address'      => $this->faker->address(),
            'consignee_phone_number' => $this->faker->numerify('9#########'),
            'consignee_gst_number'   => strtoupper($this->faker->bothify('??######??')),
            'consignee_email'        => $this->faker->safeEmail(),
            'booking_status'         => $this->faker->randomElement(['normal-booking', 'no-booking', 'client-booking']),
            'offline_booking_date'   => $this->faker->date()
        ];
    }
}
