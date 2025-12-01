<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoadingChallan extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Specify the table name
    protected $table = 'loading_challans';

    protected $fillable = [
        'id',
        'challan_number',
        'busNumber',
        'driverName',
        'driverMobile',
        'locknumber',
        'coLoder',
        'created_by',
        'from_transhipment',
        'to_transhipment',
        'deleted_at',
        'created_at',
        'updated_at',
    ];



    /**
     * Get the user that owns the phone.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }


    /**
     * The roles that belong to the user.
     */
    public function bookings(): BelongsToMany
    {
        return $this->belongsToMany(Booking::class, 'loading_challan_booking', 'loading_challans_id', 'booking_id')->whereNull('loading_challan_booking.deleted_at');
    }

    public function challanBookings()
    {
        return $this->hasMany(LoadingChallanBooking::class, 'loading_challans_id');
    }


    /*is_received_button_visible
        get for which branch should be display the received button */
    protected function getIsReceivedButtonVisibleAttribute()
    {
        $flag = false;
        if ($this->created_by != Auth::id()) {
            $flag = true;
        }
        return $flag;
    }
}
