<?php

namespace App\Http\Controllers\Report;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingReportController extends Controller
{
    public function index()
    {
        $data['title'] = 'Booking Report';
        return view('admin.report.booking-report', $data);
    }

    public function list(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        // Retrieve filter values
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
            //  $bookingQuery->where('consignee_branch_id', Auth::user()->branch_user_id);
        }

        // Apply the search filter
        if ($search) {
            $bookingQuery->where('bilti_number', 'like', "%$search%")
                ->orWhere('consignor_name', 'like', "%$search%")
                ->orWhere('consignee_name', 'like', "%$search%");
        }

        // Apply the booking type filter
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

    public function clientBooking()
    {
        $data['title'] = 'Client Bookings';
        return view('admin.report.clients', $data);
    }


    public function clientList(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        $clientQuery = Client::query();

        // For debugging, let's print the query first to see if it's being built properly
        $sql = $clientQuery->toSql(); // Get the raw SQL query
        // Apply search filters if a search term is provided
        if ($search) {
            $clientQuery->where(function ($query) use ($search) {
                $query->where('consignor_name', 'like', "%$search%")
                    ->orWhere('consignee_name', 'like', "%$search%");
            });
        }

        // Eager load the consignorBranch relationship
        $clients = $clientQuery->with('consignorBranch') // Eager load
            ->skip($start)
            ->take($limit)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalRecord = $clientQuery->count();
        $rows = [];

        if ($clients->count() > 0) {
            foreach ($clients as $index => $client) {
                $row = [];
                $row['sn'] = $start + $index + 1;
                $row['client_id'] = '<a href="' . url('admin/reports/clients/bookings/revenue', ['id' => $client->id]) . '">' . $client->id . '</a>';

                // Accessing consignor branch name safely
                $row['consignor_branch_id'] = $client->consignorBranch ? $client->consignorBranch->branch_name : 'N/A';
                $row['consignor_name'] = $client->consignor_name;
                $row['consignor_address'] = $client->consignor_address;
                $row['phone_number_1'] = $client->consignor_phone_number;
                $row['gst_number'] = $client->gst_number;
                $row['consignee_branch_id'] = $client->consigneeBranch ? $client->consigneeBranch->branch_name : 'N/A';
                $row['consignee_name'] = $client->consignee_name;
                $row['consignee_address'] = $client->consignee_address;
                $row['consignee_phone_number_1'] = $client->consignee_phone_number;
                // $row['action'] = '<a href="' . url("admin/clients/edit/{$client->id}") . '" class="btn btn-primary">Edit</a>&nbsp;
                //                   <a href="' . url("admin/clients/delete/{$client->id}") . '" class="btn btn-warning">Delete</a>';

                // Format the creation date
                $row['created_at'] = date('d-m-Y', strtotime($client->created_at));

                // Append the row to the rows array
                $rows[] = $row;
            }
        }

        // Prepare the JSON response with correct record counts
        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalRecord,
            "recordsFiltered" => $totalRecord,
            "data" => $rows,
        ];

        // Return the JSON response
        return response()->json($json_data);
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
    public function clientBookingRevenue(Request $request, $id)
    {
        $data['clientId'] = $id;
        $data['title'] = 'Bookings Revenue';

        // Get total bookings for the client
        $ClientDetails = Booking::where('client_id', $id)->get();
        // echo "<pre>";
        // print_r($ClientDetails);exit;


        $totalBookings = Booking::where('client_id', $id)->count();

        // Get pending bookings for the client
        $pendingBookings = Booking::where('client_id', $id)
            ->where('status', 2)  // Adjust the status as per your database values
            ->count();

        // Get in-branch bookings for the client
        $inBranchBookings = Booking::where('client_id', $id)
            ->where('status', 3)  // Adjust the booking type if needed
            ->count();

        // Get delivered bookings for the client
        $deliveredBookings = Booking::where('client_id', $id)
            ->where('status', 4)  // Adjust the status if applicable
            ->count();

        // Pass all booking data to the view
        $totalRevenue = Booking::where('client_id', $id)->sum('grand_total_amount');  // Adjust 'revenue' if your column is different

        // Get revenue from paid bookings
        $paidRevenue = Booking::where('client_id', $id)
            ->where('booking_type', 'paid')  // Assuming 'payment_status' is the field indicating paid status
            ->sum('grand_total_amount');  // Adjust 'revenue' if your column name is different

        // Get revenue from "to pay" bookings
        $toPayRevenue = Booking::where('client_id', $id)
            ->where('booking_type', 'Topay')  // Assuming 'payment_status' is the field indicating payment status
            ->sum('grand_total_amount');  // Adjust 'revenue' if your column name is different

        // Pass all the data to the view
        $data['ClientDetails'] = $ClientDetails;
        $data['totalRevenue'] = $totalRevenue;
        $data['paidRevenue'] = $paidRevenue;
        $data['toPayRevenue'] = $toPayRevenue;
        $data['totalBookings'] = $totalBookings;
        $data['pendingBookings'] = $pendingBookings;
        $data['inBranchBookings'] = $inBranchBookings;
        $data['deliveredBookings'] = $deliveredBookings;

        return view('admin.report.client-bookings-revenue', $data);
    }

}
