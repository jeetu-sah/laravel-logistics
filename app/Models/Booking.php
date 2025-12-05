<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;
use App\Models\Transhipment;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bookings';

    const BOOKED = 1;
    const DISPATCH = 2;
    const RECEIVED_FINAL_TRANSHIPMENT = 3;
    const DELIVERED_TO_CLIENT = 4;

    const BOOKING_TYPE_PAID = "Paid";
    const BOOKING_TYPE_TOPAY = "Topay";
    const BOOKING_TYPE_TOCLIENT = "Toclient";


    const NORMAL_BOOKING = 'normal-booking';
    const CLIENT_BOOKING = 'client-booking';
    const NO_BOOKING = 'no-booking';

    const REVERT_BOOKING = 'revert_booking';
    const CREATE_CHALLAN = 'create_challan';
    const RECEIVED_BOOKING = 'received_booking';


    // Specify the primary key (if it's not 'id')
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    // Indicate that the primary key is not an auto-incrementing integer
    public $incrementing = true;

    // Set the data type of the primary key
    protected $keyType = 'int';

    protected $fillable = [
        'id',
        'bilti_number',
        'status',
        'booking_type',
        'booking_date',
        'consignor_branch_id',
        'consignee_branch_id',
        'no_of_artical',
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
        'transhipmen_one_amount',
        'transhipmen_two_amount',
        'transhipment_three_amount',
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
        'created_at',
        'updated_at',
        'actual_weight',
        'cantain',
        'aadhar_card',
        'manual_bilty_number',
        'client_id',
        'client_to_id',
        'consignee_name',
        'consignee_address',
        'consignee_phone_number',
        'consignee_gst_number',
        'consignee_email',
        'booking_status',
        'offline_booking_date',
        'receiver_name',
        'receiver_mobile_number',
        'received_at'
    ];

    // If you want to hide attributes from arrays
    protected $hidden = [];

    public $bookingType = ['Topay' => 'To Pay', 'To Client', 'Paid' => 'Paid'];



    public function delivery_receipt()
    {
        return $this->hasOne(DeliveryReceipt::class, 'booking_id');
    }

    //visible_for
    protected function getVisibleForAttribute(): int|null
    {
        $bookingVisibleForBranch = $this->transhipments->where('status', Transhipment::PENDING)->first();
        return $bookingVisibleForBranch?->from_transhipment;
    }

    //booking_type_name
    protected function getBookingtypeNameAttribute(): string|null
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
        $nextSequence = $this->branch_specific_transhipment?->sequence_no + 1;

        return $this->transhipments->where('sequence_no', $nextSequence)
            ->where('booking_id', $this->id)->first();
    }


    /*branch's (transhipment) booking. next_booking_transhipment_name
        get next transhipments for the loggedin branch
    */
    protected function getNextBookingTranshipmentNameAttribute()
    {
        $countTranshipments = $this->getAlltranshipments->count();
        $nextSequence = $this->branch_specific_transhipment?->sequence_no + 1;
        if ($nextSequence <= $countTranshipments) {
            return $this->getAlltranshipments->where('sequence_no', $nextSequence)->where('booking_id', $this->id)->first();
        } else {
            return null;
        }
    }

    /*branch's (transhipment) booking. last_transhipment
        get next transhipments for the loggedin branch
    */
    protected function getLastTranshipmentAttribute()
    {
        if ($this->getAlltranshipments->count() > 0) {
            return $this->getAlltranshipments->last();
        }

        return null;
    }

    /*
        branch's (transhipment) booking. first_transhipment
    */
    protected function getFirstTranshipmentAttribute()
    {
        if ($this->getAlltranshipments->count() > 0) {
            return $this->getAlltranshipments->where('sequence_no', 1)->first();
        }
        return null;
    }

    /*branch's (transhipment) booking. second_last_transhipment
        get next transhipments for the loggedin branch
    */
    protected function getSecondLastTranshipmentAttribute()
    {
        if ($this->getAlltranshipments->count() > 0) {
            return $this->getAlltranshipments->reverse()->skip(1)->first();
        }

        return null;
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

    /*branch's (transhipment) booking. all_prev_booking_transhipment
        get all previous transhipments for the loggedin branch
    */
    protected function getAllPrevBookingTranshipmentAttribute()
    {
        $currentTranshipmentBranch = $this->branch_specific_transhipment;

        $allTranshiment = $this->getAlltranshipments->whereNotIn('type', [Transhipment::TYPE_SENDER, Transhipment::TYPE_RECEIVER]);
        $allTranshipmentId = $allTranshiment->pluck('from_transhipment')->toArray();

        if ($currentTranshipmentBranch->type == Transhipment::TYPE_RECEIVER) {
            if (count($allTranshipmentId) > 0) {
                $branches = Branch::whereIn('id', $allTranshipmentId)->get();
                return $branches->pluck('branch_name')->join(', ');
            }
            return '--';
        }

        if ($currentTranshipmentBranch->type == Transhipment::TYPE_SENDER) {
            return '---';
        }

        if ($currentTranshipmentBranch->type == Transhipment::TYPE_TRANSHIPMENT) {

            $transhipmentString = '';
            if (count($allTranshipmentId) > 0) {
                foreach ($allTranshiment as $transhipment) {

                    if ($transhipment->from_transhipment == $currentTranshipmentBranch->from_transhipment) {
                        break;
                    } else {
                        $transhipmentString .= $transhipment->branch->branch_name;
                    }
                }
                return $transhipmentString;
            }
        }
        return '-';
    }


    /*is_revert_button_visible
        get for which branch should be display the received button */
    protected function getIsRevertButtonVisibleAttribute()
    {

        if ($this->next_booking_transhipment?->received_at != NULL) {
            return false;
        }
        return true;
    }



    // Define the relationships if there are any
    public function transhipments()
    {
        return $this->hasMany(Transhipment::class, 'booking_id')->orderBy('sequence_no');
    }

    // Define the relationships if there are any
    public function getAlltranshipments()
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

    public function clientTo()
    {
        return $this->belongsTo(Client::class, 'client_to_id');
    }

    public function consigneeBranch()
    {
        return $this->belongsTo(Branch::class, 'consignee_branch_id');
    }

    public function acceptedTranshipments(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class, 'transhipments', 'booking_id', 'from_transhipment');
    }

    public function deliveryReceiptPayments()
    {
        return $this->hasManyThrough(
            DeliveryReceiptPayment::class,
            DeliveryReceipt::class,
            'booking_id',
            'delivery_receipt_id',
            'id',
            'id'
        );
    }

    public function getSpecificBranchBookingChallan($branchId)
    {
        return LoadingChallan::whereHas('bookings', function ($query) {
            $query->where('bookings.id', $this->id);
        })->where('from_transhipment', $branchId)->first();
    }

    public function loadingChallans()
    {
        return $this->belongsToMany(
            LoadingChallan::class,
            'loading_challan_booking',   // Pivot table
            'booking_id',                // Foreign key for this model
            'loading_challans_id'        // Foreign key for related model
        );
    }

    //outgoing_booking_commisions
    public function getOutgoingBookingCommisionsAttribute()
    {
        $commisionPrice = BranchCommision::where('consignor_branch_id', $this->consignor_branch_id)
            ->where('consignee_branch_id', $this->consignee_branch_id)
            ->first();
        if ($commisionPrice) {
            $totalBookingCommision = $this->no_of_artical * $commisionPrice->amount;
            return $totalBookingCommision;
        }
        return 0;
    }


    //incoming_booking_commisions
    public function getIncomingBookingCommisionsAttribute()
    {

        $incomingCommisionProcess = $this->consigneeBranch?->incoming_commission_price;
        if ($this->consigneeBranch && $incomingCommisionProcess) {
            $totalBookingCommision = $this->no_of_artical * $incomingCommisionProcess;
            return $totalBookingCommision;
        }
        return 0;
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($booking) {

            // Delete transhipments
            $booking->transhipments()->delete();

            // Delete loading challans pivot records
            $booking->loadingChallans()->detach();

            // Delete delivery receipt payments
            if ($booking->delivery_receipt) {
                $booking->delivery_receipt->payments()->delete();
                $booking->delivery_receipt()->delete();
            }

            // Delete booking → challan entries
            \App\Models\LoadingChallanBooking::where('booking_id', $booking->id)->delete();

            // Add more if needed (logs, images etc.)
            // \App\Models\BookingLog::where('booking_id', $booking->id)->delete();
        });
    }

    // public static function bookingCommisions($booking)
    // {

    //     $totalBookingCommision = 0;
    //     $transhipments = $booking->transhipments;
    //     if($transhipments->count() > 0) {
    //          echo "<pre>";
    //         print_r($transhipments);exit;
    //     }
    //     $commisionPrice = BranchCommision::where('consignor_branch_id', $booking->consignor_branch_id)
    //         ->where('consignee_branch_id', $booking->consignee_branch_id)
    //         ->first();
    //     if ($commisionPrice) {
    //         $price = $commisionPrice->amount;
    //         $booking->outgoing_commision = $booking->no_of_artical * $price;
    //     }

    //     $bookingTranshipment = $booking->transhipments;
    //     if ($bookingTranshipment->count() > 0) {
    //         foreach ($bookingTranshipment as $transhipment) {
    //             if ($transhipment->type == Transhipment::TYPE_SENDER) {
    //                 $nextBookigngTranshipment = $booking->next_booking_transhipment;

    //                 echo "<pre>";
    //                 print_r($booking);
    //                 exit;
    //             }
    //             if ($transhipment->type == Transhipment::TYPE_RECEIVER) {
    //             }
    //             if ($transhipment->type == Transhipment::TYPE_TRANSHIPMENT) {
    //                 if ($transhipment->from_transhipment == Auth::user()->branch_user_id) {
    //                     $commisionPrice = BranchCommision::where('consignor_branch_id', $transhipment->from_transhipment)
    //                         ->where('consignee_branch_id', $transhipment->to_transhipment)
    //                         ->first();
    //                     if ($commisionPrice) {
    //                         $totalBookingCommision = $booking->no_of_artical * $commisionPrice->amount;
    //                         return $totalBookingCommision;
    //                     }
    //                 }
    //             }

    //             echo "<pre>";
    //             print_r($transhipment);
    //             exit;
    //         }

    //         $commisionPrice = BranchCommision::where('consignor_branch_id', $booking->consignor_branch_id)
    //             ->where('consignee_branch_id', $booking->consignee_branch_id)
    //             ->first();
    //         if ($commisionPrice) {
    //             $totalBookingCommision = $booking->no_of_artical * $commisionPrice->amount;
    //             return $totalBookingCommision;
    //         }
    //     }
    //     return 0;
    // }
}
