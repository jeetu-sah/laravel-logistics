<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingService
{

    public static function updateBookingStatus(Booking $booking)
    {
        if (Auth::user()) {
            $branchId = Auth::user()->branch_user_id;
            $lastTranshipment = $booking->last_transhipment;
            if ($branchId == $lastTranshipment->from_transhipment) {
                $booking->status = Booking::DELIVERED;
            } else {
                $booking->status = Booking::DISPATCH;
            }
            
            $booking->save();
            return $booking;
        }
    }
}
