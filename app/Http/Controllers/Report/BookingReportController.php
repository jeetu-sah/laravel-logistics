<?php

namespace App\Http\Controllers\Report;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Branch;
use App\Models\DeliveryReceipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingReportController extends Controller
{
    public function index()
    {

        $data['client'] = Client::all();
        $data['title'] = 'Booking Report';
        return view('admin.report.booking-report', $data);
    }

    public function clientBookingList(Request $request, $id)
    {
        $data['clientId'] = $id;
        $data['title'] = 'Bookings';
        return view('admin.report.client-bookings', $data);
    }



    public function clientBookingview(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        // Retrieve filter values
        $client_id = $request->input('client_id');
        $bookingType = $request->input('booking_type');
        $bookingstatus = $request->input('status');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $bookingQuery = Booking::query();

        // Check if the logged-in user is an admin or branch user
        if (Auth::user()->is_admin) {
            // If admin, show all bookings
        } else {
            // If branch user, show only records for their branch
            $bookingQuery->where('consignor_branch_id', Auth::user()->branch_user_id);
        }

        // Apply the search filter
        if ($search) {
            $bookingQuery->where('bilti_number', 'like', "%$search%")
                ->orWhere('consignor_name', 'like', "%$search%")
                ->orWhere('consignee_name', 'like', "%$search%");
        }

        // Apply the booking type filter
        if ($client_id) {
            $bookingQuery->where('client_id', $client_id);
        }
        if ($bookingType) {
            $bookingQuery->where('booking_type', $bookingType);
        }
        if ($bookingstatus) {
            $bookingQuery->where('status', $bookingstatus);
        }

        // Apply the date range filter
        if ($fromDate) {
            $bookingQuery->whereDate('created_at', '>=', $fromDate);
        }

        if ($toDate) {
            $bookingQuery->whereDate('created_at', '<=', $toDate);
        }

        // Get total count of records
        $totalRecord = $bookingQuery->count();

        // Fetch bookings with pagination (skip and take)
        $bookings = $bookingQuery->skip($start)->take($limit)->orderBy('created_at', 'desc')->get();

        $rows = [];
        if ($bookings->count() > 0) {
            foreach ($bookings as $index => $booking) {
                $row = [];
                if ($request->bilti_list_type === 'challan') {
                    $row['sn'] = '<div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="bookingId[]" value="' . $booking->id . '">
                                            <label class="form-check-label" for="exampleCheck1"></label>
                                        </div>';
                } else {
                    $row['sn'] = $start + $index + 1;
                }

                $row['bilti_number'] = '<a href="' . route('bookings.bilti', ['id' => $booking->id]) . '" target="_blank">' . $booking->bilti_number . '</a>';
                $row['offline_bilti'] = $booking->manual_bilty_number
                    ? '<a href="' . route('bookings.bilti', ['id' => $booking->id]) . '" target="_blank">' . $booking->manual_bilty_number . '</a>'
                    : '-';

                $row['consignor_branch_id'] = $booking?->consignorBranch?->branch_name;
                $row['consignor_name'] = $booking->consignor_name;
                $row['address'] = $booking->consignor_address;
                $row['phone_number_1'] = $booking->phone_number_1;
                $row['gst_number'] = $booking->gst_number;
                $row['consignee_branch_id'] = $booking?->consigneeBranch?->branch_name;
                $row['consignee_name'] = $booking->consignee_name;
                $row['consignee_address'] = $booking->consignee_address;
                $row['consignee_phone_number_1'] = $booking->consignee_phone_number_1;

                if ($booking->booking_type == 'Paid') {
                    $row['booking_type'] = 'Paid ';
                } elseif ($booking->booking_type == 'Topay') {
                    $row['booking_type'] = 'To Pay ';
                }

                if ($booking->status == 1) {
                    $row['action'] = '<span class="badge bg-primary">Booked</span>';
                } elseif ($booking->status == 2) {
                    $row['action'] = '<span class="badge bg-warning">Dispatch</span>';
                } elseif ($booking->status == 3) {
                    $row['action'] = '<span class="badge bg-info">Reached</span>';
                } elseif ($booking->status == 4) {
                    $row['action'] = '<span class="badge bg-success">Delivered</span>';
                }

                $row['created_at'] = date('d-m-Y', strtotime($booking->created_at));

                $rows[] = $row;
            }
        }

        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalRecord,
            "recordsFiltered" => $totalRecord,
            "data" => $rows,
        ];

        return response()->json($json_data);
    }
    public function clientBookingRevenue(Request $request, $fromId, $toId)
    {
        $data['title'] = 'Bookings Revenue';
        $data['from_clientId'] = $fromId;
        $data['to_clientId'] = $toId;

        // Common condition for both directions
        $matchClient = function ($query) use ($fromId, $toId) {
            $query->where(function ($q) use ($fromId, $toId) {
                $q->where('from_client_id', $fromId)->where('to_client_id', $toId);
            })->orWhere(function ($q) use ($fromId, $toId) {
                $q->where('from_client_id', $toId)->where('to_client_id', $fromId);
            });
        };

        // Booking details
        $data['ClientDetails'] = Booking::where($matchClient)->get();
        $data['totalBookings'] = Booking::where($matchClient)->count();
        $data['pendingBookings'] = Booking::where($matchClient)->where('status', 2)->count();
        $data['inBranchBookings'] = Booking::where($matchClient)->where('status', 3)->count();
        $data['deliveredBookings'] = Booking::where($matchClient)->where('status', 4)->count();
        $data['totalRevenue'] = Booking::where($matchClient)
            ->where('status', 4)
            ->sum('grand_total_amount');

        $data['paidRevenue'] = Booking::where($matchClient)
            ->where('status', 4)
            ->where('booking_type', 'paid')
            ->sum('grand_total_amount');

        $data['toPayRevenue'] = Booking::where($matchClient)
            ->where('status', 4)
            ->where('booking_type', 'Topay')
            ->sum('grand_total_amount');

        // Delivery Receipt details
        $matchReceipt = function ($query) use ($fromId, $toId) {
            $query->where(function ($q) use ($fromId, $toId) {
                $q->where('from_id', $fromId)->where('to_id', $toId);
            })->orWhere(function ($q) use ($fromId, $toId) {
                $q->where('from_id', $toId)->where('to_id', $fromId);
            });
        };

        $clientRevenue = DeliveryReceipt::where($matchReceipt)->get();
        $data['totalAmount'] = $clientRevenue->sum('grand_total');
        $data['totalreceived_amount'] = $clientRevenue->sum('received_amount');

        return view('admin.report.client-bookings-revenue', $data);
    }



}
