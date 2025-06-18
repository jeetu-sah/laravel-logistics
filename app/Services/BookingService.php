<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Echo_;

class BookingService
{

    public static function updateBookingStatus(Booking $booking, $action)
    {
        if (Auth::user()) {
            $branchId = Auth::user()->branch_user_id;

            switch ($action) {
                case 'create_challan':
                    $booking->status = Booking::DISPATCH;
                    return $booking;

                case 'received_booking':
                    $lastTranshipment = $booking->last_transhipment;
                    if ($branchId == $lastTranshipment->from_transhipment) {
                        $booking->status = Booking::RECEIVED_FINAL_TRANSHIPMENT;
                    } else {
                        $booking->status = Booking::DISPATCH;
                    }
                    $booking->save();
                    return $booking;

                case 'revert_booking':
                    $firstTranshipment = $booking->first_transhipment;
                    if ($branchId == $firstTranshipment->from_transhipment) {
                        $booking->status = Booking::BOOKED;
                    } else {
                        $booking->status = Booking::DISPATCH;
                    }
                    $booking->save();
                    return $booking;

                default:
                    // Optionally return something or do nothing
                    break;
            }
        }
    }
}
