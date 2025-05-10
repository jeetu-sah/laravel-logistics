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

    public function list(Request $request)
    {
       
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        // Retrieve filter values
        $clientName = $request->input('client_name');
        $bookingType = $request->input('booking_type');
        $bookingStatus = $request->input('status');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $bookingQuery = Booking::query();

        // Check if the logged-in user is an admin or branch user
        if (Auth::user()->is_admin) {
            // If admin, show all bookings
        } else {
            // If branch user, show only records for their branch
            $bookingQuery->where('consignee_branch_id', operator: Auth::user()->branch_user_id)
                ->orWhere('consignor_branch_id', Auth::user()->branch_user_id);
        }

        // Apply the search filter
        if ($clientName) {
            $bookingQuery->where('client_id', $clientName);
        }

        if ($bookingType) {
            $bookingQuery->where('booking_type', $bookingType);
        }

        if ($bookingStatus) {
            $bookingQuery->where('status', $bookingStatus);
        }

        if ($fromDate && $toDate) {
            $bookingQuery->whereBetween('created_at', [$fromDate, $toDate]);
        }
        if ($search) {
            $bookingQuery->where(function ($query) use ($search) {
                $query->where('client_name', 'LIKE', "%$search%")
                    ->orWhere('booking_reference', 'LIKE', "%$search%")
                    ->orWhere('status', 'LIKE', "%$search%");
            });
        }

        // Get total count of records (for pagination)
        $totalRecords = $bookingQuery->count();

        // Fetch bookings with pagination (skip and take)
        $bookings = $bookingQuery->skip($start)->take($limit)->get();

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
                    : 'N/A';

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

        // Return the response in a structured way for DataTables
        return response()->json([
            'draw' => $request->input('draw'),  // This is for DataTables pagination
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,  // Modify this if you need to filter records count separately
            'data' => $rows
        ]);
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

        $branchId = Auth::user()->branch_user_id;

        $query = DB::table('client_to_client_map')
            ->join('clients as from_clients', 'from_clients.id', '=', 'client_to_client_map.from_client_id')
            ->join('clients as to_clients', 'to_clients.id', '=', 'client_to_client_map.to_client_id')

            // Join for from_client's branch
            ->join('client_branch_map as from_cbm', 'from_cbm.client_id', '=', 'from_clients.id')
            ->join('branches as from_branches', 'from_branches.id', '=', 'from_cbm.branch_id')

            // Join for to_client's branch
            ->join('client_branch_map as to_cbm', 'to_cbm.client_id', '=', 'to_clients.id')
            ->join('branches as to_branches', 'to_branches.id', '=', 'to_cbm.branch_id')

            ->where('from_cbm.branch_id', $branchId)

            ->select(
                'client_to_client_map.*',
                'from_clients.client_name as from_client_name',
                'from_clients.client_phone_number as from_client_phone_number',

                'to_clients.client_name as to_client_name',
                'to_clients.client_phone_number as to_client_phone_number',

                'from_branches.branch_name as from_branch_name',
                'from_branches.id as from_branch_id',

                'to_branches.branch_name as to_branch_name',
                'to_branches.id as to_branch_id'
            );




        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('from_clients.client_name', 'like', "%$search%")
                    ->orWhere('to_clients.client_name', 'like', "%$search%");
            });
        }

        $total = $query->count();

        $clients = $query
            ->orderBy('client_to_client_map.created_at', 'desc')
            ->skip($start)
            ->take($limit)
            ->get();

        // Prepare data
        $rows = [];
        $data = [];

        foreach ($clients as $index => $client) {
            $row = [];
            $row['sn'] = $start + $index + 1;

            // Link to booking with from_client_id
            $row['client_ids'] =
                '<a href="' . url('admin/reports/clients/bookings/revenue', [
                    'fromId' => $client->from_client_id,
                    'toId' => $client->to_client_id
                ]) . '" class="btn btn-sm btn-warning">
                View Bookings
            </a>';


            $row['from_client_name'] = $client->from_client_name;

            $row['to_client_name'] = $client->to_client_name;
            $row['to_client_phone_number'] = $client->to_client_phone_number ?? '-';
            $row['to_branch_name'] = $client->to_branch_name ?? '-';

            $row['created_at'] = $client->created_at;
            $row['action'] = '<a href="' . url("admin/clients/edit/{$client->id}") . '" class="btn btn-primary">Edit</a>&nbsp;
            <a href="' . url("admin/clients/delete/{$client->id}") . '" class="btn btn-warning">Delete</a>';
            $data[] = $row;
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data,
        ]);
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
