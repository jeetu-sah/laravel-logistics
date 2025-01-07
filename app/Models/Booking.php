<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;


class Booking extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'bookings';

    // Specify the primary key (if it's not 'id')
    protected $primaryKey = 'id';

    // Indicate that the primary key is not an auto-incrementing integer
    public $incrementing = true;

    // Set the data type of the primary key
    protected $keyType = 'int';

    // Allow mass assignment for these fields
    protected $fillable = [
        'consignor_branch_id',
        'consignor_name',
        'address',
        'phone_number_1',
        'phone_number_2',
        'email',
        'gst_number',
        'pin_code',
        'consignee_branch_id',
        'consignee_name',
        'consignee_address',
        'consignee_phone_number_1',
        'consignee_phone_number_2',
        'consignee_email',
        'consignee_gst_number',
        'consignee_pin_code',
        'no_of_pkg',
        'actual_weight',
        'packing_type',
        'freight_amount',
        'os_amount',
        'fov_amount',
        'transhipment_amount',
        'handling_charge_amount',
        'loading_charge_amount',
        'misc_charge_amount',
        'other_charge_amount',
        'grand_total_amount',
        'booking_type',
        'status'
    ];

    // If you want to hide attributes from arrays
    protected $hidden = [];

    // If you want to cast attributes to a different type
    protected $casts = [
        'actual_weight' => 'string', // This is needed if actual_weight is a string in the schema
        'freight_amount' => 'decimal:2',
        'os_amount' => 'decimal:2',
        'fov_amount' => 'decimal:2',
        'transhipment_amount' => 'decimal:2',
        'handling_charge_amount' => 'decimal:2',
        'loading_charge_amount' => 'decimal:2',
        'misc_charge_amount' => 'decimal:2',
        'other_charge_amount' => 'decimal:2',
        'grand_total_amount' => 'decimal:2',
    ];

    // Define the relationships if there are any
    public function consignorBranch()
    {
        return $this->belongsTo(Branch::class, 'consignor_branch_id');
    }

    public function consigneeBranch()
    {
        return $this->belongsTo(Branch::class, 'consignee_branch_id');
    }

   

}
