<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;
use App\Models\Transhipment;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;

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

    public $bookingType = ['Topay' => 'To Pay', 'To Client', 'Paid' => 'Paid'];


    //visible_for
    protected function getVisibleForAttribute(): Int | null
    {
        $bookingVisibleForBranch = $this->transhipments->where('status', Transhipment::PENDING)->first();
        return $bookingVisibleForBranch?->from_transhipment;
    }

    //booking_type_name
    protected function getBookingtypeNameAttribute(): string | null
    {
        return $this->bookingType[$this->booking_type];
    }

    //booking_created_by
    protected function getBookingCreatedByAttribute(): string
    {
        return ($this->consignor_branch_id == auth()->user()->branch->id) ? 'Self' : $this->consignorBranch->branch_name;
    }


    /*branch's (transhipment) booking. branch_specific_transhipment
        get transhipments for the active branch
        getBranchSpecificBookingsAttribute
    */
    protected function getBranchSpecificTranshipmentAttribute()
    {
        return $this->transhipments->where('from_transhipment', Auth::user()->branch_user_id)
            ->where('booking_id', $this->id)->first();
    }


    /*branch's (transhipment) booking. next_booking_transhipment
        get next transhipments for the loggedin branch
    */
    protected function getNextBookingTranshipmentAttribute()
    {
        $nextSequence = $this->branch_specific_transhipment->sequence_no + 1;

        return $this->transhipments->where('sequence_no', $nextSequence)
            ->where('booking_id', $this->id)->first();
    }

    /*branch's (transhipment) booking. prev_booking_transhipment
        get previous transhipments for the loggedin branch
    */
    protected function getPrevBookingTranshipmentAttribute()
    {
        $prevSequence = $this->branch_specific_transhipment->sequence_no - 1;
        return $this->transhipments->where('sequence_no', $prevSequence)
            ->where('booking_id', $this->id)->first();
    }

    
    /*is_revert_button_visible
        get for which branch should be display the received button */
    protected function getIsRevertButtonVisibleAttribute()
    {
        if($this->next_booking_transhipment->received_at != NULL) {
            return false;
        }
        return true;
    }



    // Define the relationships if there are any
    public function transhipments()
    {
        return $this->hasMany(Transhipment::class, 'booking_id')->orderBy('sequence_no');
    }
    public function transhipment()
    {
        return $this->hasOne(Transhipment::class, 'booking_id', 'id');
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

    public function acceptedTranshipments(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class, 'transhipments', 'booking_id', 'from_transhipment');
    }
}
