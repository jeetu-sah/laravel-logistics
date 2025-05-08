<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;
use App\Models\Transhipment;


class Booking extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'bookings';

    const BOOKED = 1;
    const DISPATCH = 2;
    const ACCEPT = 3;
    const DELIVERED_TO_CLIENT = 4;

    // Specify the primary key (if it's not 'id')
    protected $primaryKey = 'id';

    // Indicate that the primary key is not an auto-incrementing integer
    public $incrementing = true;

    // Set the data type of the primary key
    protected $keyType = 'int';

    // Allow mass assignment for these fields
    protected $fillable = [
        'booking_date',

        'consignor_branch_id',

        'consignee_branch_id',

        'no_of_artical',
        'actual_weight',
        'cantain',
        'good_of_value',
        'consignor_name',

        'consignor_address',

        'consignor_phone_number',

        'consignor_gst_number',

        'consignor_email',

        'invoice_number',
        'eway_bill_number',
        'mark',
        'remark',
        'photo_id',
        'parcel_image',
        'distance',
        'freight_amount',
        'wbc_charges',
        'handling_charges',
        'fov_amount',
        'fuel_amount',

        'pickup_charges',
        'hamali_Charges',
        'bilti_Charges',
        'discount',
        'compney_charges',
        'sub_total',
        'cgst',
        'sgst',
        'igst',
        'grand_total',
        'misc_charge_amount',
        'grand_total_amount',
        'bilti_number',        // Add this line
        'status',              // Add this line
        'booking_type',        // Add this line
    ];

    // If you want to hide attributes from arrays
    protected $hidden = [];

    // If you want to cast attributes to a different type
    // protected $casts = [
    //     'actual_weight' => 'string', // This is needed if actual_weight is a string in the schema
    //     'freight_amount' => 'decimal:2',
    //     'os_amount' => 'decimal:2',
    //     'fov_amount' => 'decimal:2',
    //     'transhipment_amount' => 'decimal:2',
    //     'handling_charge_amount' => 'decimal:2',
    //     'loading_charge_amount' => 'decimal:2',
    //     'misc_charge_amount' => 'decimal:2',
    //     'other_charge_amount' => 'decimal:2',
    //     'grand_total_amount' => 'decimal:2',
    // ];


    


    // Define the relationships if there are any
    public function transhipments()
    {
        return $this->hasMany(Transhipment::class, 'booking_id');
    }
    public function consignorBranch()
    {
        return $this->belongsTo(Branch::class, 'consignor_branch_id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function consigneeBranch()
    {
        return $this->belongsTo(Branch::class, 'consignee_branch_id');
    }



}
