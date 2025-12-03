<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class IncomingBookingController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function incomingLoad()
    {
        $data['title'] = 'Incoimg Load';
        return view('admin.incoming-booking.incoming-load', $data);
    }

    public function upcomingBookings(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        $userBranchId = Auth::user()->branch_user_id;

        $bookingQuery = Booking::with(['consigneeBranch', 'client', 'transhipments', 'consignorBranch', 'getAlltranshipments', 'loadingChallans'])
            ->whereIn('status', [Booking::BOOKED, Booking::DISPATCH])
            ->where('consignee_branch_id', $userBranchId)
            ->whereHas('transhipments', function ($query) use ($userBranchId) {
                $query->where('dispatched_at', NULL)->where('received_at', NULL);
            });

        if ($search) {
            $bookingQuery->where(function ($query) use ($search) {
                $query->where('bilti_number', 'like', "%$search%")
                    ->orWhere('consignor_name', 'like', "%$search%")
                    ->orWhere('consignee_name', 'like', "%$search%")
                    ->orWhereHas('client', function ($q) use ($search) {
                        $q->where('client_name', 'like', "%$search%");
                    });
            });
        }
        $totalRecord = $bookingQuery->count();

        $bookings = $bookingQuery->skip($start)->take($limit)->orderBy('created_at', 'desc')->get();
        $rows = [];
        if ($bookings->count() > 0) {
            foreach ($bookings as $index => $booking) {
                //find loading challan details
                $loadingChallans = $booking->loadingChallans;
                $driverNameDetails = '--';
                $challanNumber = '--';
                if ($loadingChallans->count() > 0) {
                    $driverDetails = $loadingChallans->where('from_transhipment', $booking->consignorBranch->id)->first();
                    if ($driverDetails) {
                        $challanNumber = $driverDetails->challan_number;
                        $driverNameDetails = $driverDetails->driverName . '/<br />' . $driverDetails->driverMobile .'/<br />'.$driverDetails->busNumber;
                    }
                }
                //transhipment
                $transhipments = '--';
                if ($booking->getAlltranshipments->count() > 2) {
                    $transhipments = $booking->all_prev_booking_transhipment;
                }

                $row = [];
                if ($request->bilti_list_type === 'challan') {
                    $row['sn'] = '<div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="bookingId[]" value="' . $booking->booking_id . '">
                                        <label class="form-check-label" for="exampleCheck1"></label>
                                    </div>';
                } else {
                    $row['sn'] = $start + $index + 1;
                }

                // Bilti and offline bilti links
                $row['bilti_number'] = '<a href="' . url("admin/bookings/print-bilti/$booking->id") . '" target="_blank">' . $booking->bilti_number . '</a>';
                $row['challan_number'] = $challanNumber;
                $row['offline_bilti_number'] = $booking->manual_bilty_number;
                $row['manual_bilty_number'] = $booking->manual_bilty_number;
                $row['offline_booking_date'] = $booking->offline_booking_date ? formatOnlyDate($booking->offline_booking_date) : null;
                $row['offline_bilti'] = $booking->manual_bilty_number  ? '<a href="" target="_blank">' . $booking->offline_booking_date . '</a>' : 'N/A';;
                $row['consignor_branch'] = $booking?->consignorBranch?->branch_name;
                $row['consignee_branch'] = $booking?->consigneeBranch?->branch_name;
                $row['consignor_name'] = $booking?->consignor_name;
                $row['grand_total_amount'] = "&#8377;" . $booking?->grand_total_amount;
                $row['driver_name_details'] = $driverNameDetails;
                $row['consignee_name'] = $booking?->consignee_name;
                $row['booking_type'] = '<span class="badge badge-danger">' . $booking->booking_type_name . '</span>' ?? '--';
                $row['no_of_artical'] = '<span class="badge badge-primary">' . $booking->no_of_artical . '</span>' ?? '--';

                // Adding Transhipment Amounts (showing each transhipment charge)
                $row['booking'] = $booking;
                $row['transhipment'] = $transhipments;
                $row['created_at'] = formatDate($booking->created_at);
                $rows[] = $row;
            }
        }

        // Return the response with the rows and total record count
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecord,
            'recordsFiltered' => $totalRecord,
            'data' => $rows,
        ]);
    }
}
