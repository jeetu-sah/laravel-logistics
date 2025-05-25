<?php

namespace App\Http\Controllers\BranchUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Library\sHelper;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $data['title'] = 'Branch | Dashboard';
        $data['roles'] = Auth::user()->roles;
        $data['selectedRole'] = sHelper::activeLoggedInUserRole(Auth::user());
        $data['totalBooking'] = Booking::where('consignee_branch_id', Auth::user()->branch_user_id)->count();
        return view('branchuser.dashboard.dashboard')->with($data);
    }


    public function reports(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());exit;.

        // $bookings = Booking::where('consignor_branch_id', Auth::user()->branch_user_id)->get();
        $bookingCounts = Booking::selectRaw('booking_status, COUNT(*) as count')
            ->where('consignor_branch_id', Auth::user()->branch_user_id)
            ->groupBy('booking_status')
            ->pluck('count', 'booking_status')->toArray();

        $numberOfbookingReports = [$bookingCounts['no-booking'] ?? 0, $bookingCounts['normal-booking'] ?? 0, $bookingCounts['client-booking'] ?? 0];


        return response()->json([
            'success' => true,
            'data' => ['numberOfbookingReports' => $numberOfbookingReports]
        ]);
    }

    public function upcomingBookings(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);


        $bookingQuery = Booking::with(['consigneeBranch']);
        $bookingQuery->where([['consignor_branch_id', '=', Auth::user()->branch_user_id], ['status', '=', Booking::BOOKED]]);
        if ($search) {
            $bookingQuery->where('bilti_number', 'like', "%$search%")
                ->orWhere('consignor_name', 'like', "%$search%")
                ->orWhere('consignee_name', 'like', "%$search%")
                ->orWhere('clients.client_name', 'like', "%$search%"); // Added client name search
        }
        $bookingQuery->where('bookings.status', Booking::BOOKED);

        $totalRecord = $bookingQuery->count();

        $bookings = $bookingQuery->skip($start)->take($limit)->orderBy('created_at', 'desc')->get();

        $rows = [];
        if ($bookings->count() > 0) {
            foreach ($bookings as $index => $booking) {
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
                $row['bilti_number'] = '<a href="" target="_blank">' . $booking->bilti_number . '</a>';
                $row['offline_bilti'] = $booking->manual_bilty_number  ? '<a href="" target="_blank">' . $booking->manual_bilty_number . '</a>' : 'N/A';;


                $row['consignor_branch_id'] = $booking?->consignorBranch?->branch_name;
                $row['consignor_name'] = $booking->consignor_name;
                $row['address'] = $booking->consignor_address;
                $row['phone_number_1'] = $booking->consignor_phone_number;
                $row['gst_number'] = $booking->consignor_gst_number;
                $row['consignee_branch_id'] = $booking?->consigneeBranch?->branch_name;
                $row['consignee_address'] = $booking->consignee_address;
                $row['consignee_phone_number_1'] = $booking->consignee_phone_number;
                $row['booking_type'] = '<span class="badge badge-danger">' . $booking->booking_type_name . '</span>' ?? '--';

                // Adding Transhipment Amounts (showing each transhipment charge)
                $row['transhipment_one_amount'] = $booking->transhipmen_one_amount;
                $row['transhipment_two_amount'] = $booking->transhipmen_two_amount;
                $row['transhipment_three_amount'] = $booking->transhipment_three_amount;

                // Action for updating status
                $row['action'] = '<button class="btn btn-success" onclick="updateBookingStatus(' . $booking->id . ')">Receive Maal</button>';

                $row['created_at'] = formatDate($booking->created_at);
                // Add the row to the rows array
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
