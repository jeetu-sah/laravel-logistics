<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Library\sHelper;
use App\Models\Booking;
use App\Models\Transhipment;
use App\Models\Client;
use App\Models\ClientMap;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Psy\Readline\Transient;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function incomingLoad()
    {
        $data['title'] = 'Incoimg Load';
        return view('admin.booking.incoming-load', $data);
    }

    public function index()
    {
        $data['title'] = 'Bookings';
        return view('admin.booking.booking-list', $data);
    }

    public function list(Request $request)
    {

        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        // Start of query
        $bookingQuery = Booking::with(['client', 'consigneeBranch', 'consigneeBranch']);
        // Filter by branch
        $bookingQuery->where('consignor_branch_id', Auth::user()->branch_user_id);
        // Search functionality
        if ($search) {
            $bookingQuery->where('bilti_number', 'like', "%$search%")
                ->orWhere('consignor_name', 'like', "%$search%")
                ->orWhere('consignee_name', 'like', "%$search%")
                ->orWhere('clients.client_name', 'like', "%$search%"); // Added client name search
        }
        // Count the total records
        $totalRecord = $bookingQuery->count();

        // Apply pagination and order
        $bookings = $bookingQuery->skip($start)->take($limit)->orderBy('bookings.created_at', 'desc')->get();

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

                // Bilti and offline bilti links
                $row['bilti_number'] = '<a href="' . route('bookings.bilti', ['id' => $booking->id]) . '" target="_blank">' . $booking->bilti_number . '</a>';
                $row['offline_bilti'] = $booking->manual_bilty_number
                    ? '<a href="' . route('bookings.bilti', ['id' => $booking->id]) . '" target="_blank">' . $booking->manual_bilty_number . '</a>'
                    : 'N/A';

                // Consignor and consignee information
                $row['consignor_branch_id'] = $booking?->consignorBranch?->branch_name ?? 'N/A';
                $row['consignor_name'] = $booking->consignor_name ?? 'N/A';
                $row['address'] = $booking->consignor_address ?? 'N/A';
                $row['gst_number'] = $booking->gst_number ?? 'N/A';
                $row['consignee_branch_id'] = $booking?->consigneeBranch?->branch_name ?? 'N/A';
                $row['consignee_name'] = $booking->consignee_name;
                $row['consignee_address'] = $booking->consignee_address;
                $row['booking_type'] = '<span class="badge badge-danger">' . $booking->booking_type . '</span>';
                $row['next_delivery_location'] = '<span class="badge badge-primary">' . $booking?->next_booking_transhipment?->branch?->branch_name ?? '--' . '</span>';
                $row['action'] = '<a href="' . url("admin/clients/bookings/edit/{$booking->booking_id}") . '" class="btn btn-primary">Edit</a>&nbsp;<a href="' . url("admin/bookings/bilti/{$booking->booking_id}") . '" class="btn btn-warning">Print</a>';
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


    public function create(Request $request)
    {
        $data['title'] = "Create New Booking";
        $data['user'] = auth()->user();
        $data['branch'] = Branch::all();
        $data['noBillBookings'] = $request->query('no-bill-bookings'); // true, false or null
        $data['bookingType'] = $request->query('booking');
        $data['currentBranch']  = Branch::currentbranch();

        $data['clients']  = $data['currentBranch']->clients;
        return view('admin.booking.create', $data);
    }


    public function challanBookingList(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        $userBranchId = Auth::user()->branch_user_id;

        $bookingQuery = Booking::with(['client', 'getAlltranshipments', 'transhipments' => function ($query) use ($userBranchId) {
            $query->where('from_transhipment', $userBranchId);
        }])->whereHas('transhipments', function ($query) use ($userBranchId) {
            $query->where('from_transhipment', $userBranchId)
                ->where('dispatched_at', NULL)
                ->where('received_at', '!=', NULL);
        })->whereIn('status', [Booking::BOOKED, Booking::DISPATCH]);

        // Count the filtered records
        $bookingsCount = $bookingQuery->count();
        // Get the actual records with pagination
        $bookings = $bookingQuery->skip($start)->take($limit)->orderBy('bookings.created_at', 'desc')->get();


        $rows = [];
        if ($bookings->count() > 0) {
            foreach ($bookings as $index => $booking) {
                $row = [];
                // Conditional logic for 'bilti_list_type'
                if ($request->bilti_list_type === 'challan') {
                    $row['sn'] = '<div class="form-check">
                                      <input type="checkbox" class="form-check-input" name="bookingId[]" value="' . $booking->id . '">
                                      <label class="form-check-label" for="exampleCheck1"></label>
                                  </div>';
                } else {
                    $row['sn'] = $start + $index + 1;
                }

                // Link for 'bilti_number' and 'offline_bilti'
                $row['bilti_number'] = '<a target="_blank" href="' . route('bookings.bilti', ['id' => $booking->id]) . '">' . $booking->bilti_number . '</a>';
                $row['offline_bilti'] = $booking->manual_bilty_number
                    ? '<a target="_blank" href="' . route('bookings.bilti', ['id' => $booking->id]) . '">' . $booking->manual_bilty_number . '</a>'
                    : '-';

                // Consignor details
                $row['consignor_branch_id'] = $booking?->consignorBranch?->branch_name;
                $row['consignor_name'] = $booking->consignor_name ?? '--';

                $row['phone_number_1'] = $booking->consignor_phone_number ?? '--';
                $row['gst_number'] = $booking->gst_number;

                // Consignee details
                $row['consignee_branch_id'] = $booking?->consigneeBranch?->branch_name;
                $row['consignee_name'] = $booking->consignee_name ?? '--';

                $row['consignee_branch_id'] = $booking->client->client_address ?? '--';
                $row['consignee_phone_number_1'] = $booking->consignee_phone_number ?? '';

                // Conditional logic for 'booking_type'
                $row['booking_type'] = '<span class="badge badge-danger">' . $booking->booking_type_name . '</span>';
                $row['next_delivery_location'] = '<span class="badge badge-primary">' . $booking?->next_booking_transhipment_name?->branch?->branch_name ?? '--' . '</span>';
                // Action buttons (Edit and Print)
                $row['action'] = '<a href="' . url("admin/bookings/edit/{$booking->id}") . '" class="btn btn-primary">Edit</a>&nbsp;
                                  <a href="' . url("admin/bookings/bilti/{$booking->id}") . '" class="btn btn-warning">Print</a>';

                // Created timestamp
                $row['created_at'] = formatDate($booking->created_at);
                $rows[] = $row;
            }
        }

        // Prepare the response data
        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $bookingsCount,
            "recordsFiltered" => $bookingsCount,
            "data" => $rows,
        ];

        // Return the JSON response
        return response()->json($json_data);
    }



    public function noBill()
    {
        $data['branch'] = Branch::all();
        $data['tittle'] = "No Bill";
        return view('admin.booking.create-no-bill-booking', $data);
    }

    public function bilti($id)
    {
        $data['booking'] = Booking::with(['client', 'transhipments'])->findOrFail($id);
        $branchCode1 = $data['booking']->consignor_branch_id;
        $branchCode2 = $data['booking']->consignee_branch_id;

        // Get the branch details for consignor and consignee
        $branch1 = Branch::find($branchCode1);
        $branch2 = Branch::find($branchCode2);

        // Default values for consignor and consignee states and cities
        $data['consignorAddress'] = $branch1->address1;
        $data['consignorCity'] = $branch1->branch_name;
        $data['consigneeCity'] = $branch2->branch_name;
        $data['branch1Contact'] = $branch1->contact;
        $data['branch2Contact'] = $branch2->contact;

        // Handle transhipment data
        $transhipments = $data['booking']->transhipments;

        // Default data for transhipments if none exist
        if ($transhipments->isEmpty()) {
            $transhipments = collect([
                (object) [
                    'from_transhipment' => $branch1->branch_name,
                    'sequence_no' => 1
                ]
            ]);
        }
        $data['transhipments'] = $transhipments;

        foreach ($data['transhipments'] as $transhipment) {
            $transhipment->from_transhipment_name = Branch::find($transhipment->from_transhipment)->branch_name ?? 'NA';
        }

        // Return the view with data
        return view('admin.booking.bilti', $data);
    }


    public function show()
    {
        $data['tittle'] = "Client List";
        return view('admin.booking.clientList', $data);
    }

    public function clintList(Request $request)
    {

        // Get input values from the request
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        // Start with the query builder
        $clientQuery = Client::query();

        $clientQuery->where('client_branch_id', Auth::user()->branch_user_id);
        // For debugging, let's print the query first to see if it's being built properly
        $sql = $clientQuery->toSql(); // Get the raw SQL query
        // Apply search filters if a search term is provided
        if ($search) {
            $clientQuery->where(function ($query) use ($search) {
                $query->where('client_name', 'like', "%$search%");
            });
        }

        // Filter active clients (status = 1)
        $clientQuery->where('status', 1);

        // Get the paginated results with branch details
        $clients = $clientQuery->with('branch') // Eager load branch
            ->skip($start)
            ->take($limit)
            ->orderBy('created_at', 'desc')
            ->get();
        // Get the total record count before pagination
        $totalRecord = $clientQuery->count();

        // Get the paginated results
        $clients = $clientQuery->skip($start)->take($limit)->orderBy('created_at', 'desc')->get();

        // Prepare data for the response
        $rows = [];
        if ($clients->count() > 0) {
            foreach ($clients as $index => $client) {
                $row = [];
                $row['sn'] = $start + $index + 1;
                $row['client_id'] = '<a href="' . url('admin/bookings/to-client-booking', ['id' => $client->id]) . '">' . $client->id . '</a>';


                $row['consignor_branch_id'] = $client->consignorBranch?->branch_name ?? 'N/A';
                $row['consignor_name'] = $client->consignor_name;
                $row['consignor_address'] = $client->consignor_address;
                $row['phone_number_1'] = $client->consignor_phone_number;
                $row['gst_number'] = $client->gst_number;
                $row['consignee_branch_id'] = $client->consigneeBranch?->branch_name ?? 'N/A';
                $row['consignee_name'] = $client->consignee_name;
                $row['consignee_address'] = $client->consignee_address;
                $row['consignee_phone_number_1'] = $client->consignee_phone_number;
                $row['action'] = '<a href="' . url("admin/clients/edit/{$client->id}") . '" class="btn btn-primary">Edit</a>&nbsp;
                              <a href="' . url("admin/clients/delete/{$client->id}") . '" class="btn btn-warning">Delete</a>';

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

    public function Clientshow()
    {

        $data['tittle'] = "Client List";
        return view('admin.booking.clientList', $data);
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
            $row['from_client_id'] = '<a href="' . url('admin/bookings/clients/bookings', ['id' => $client->id]) . '">' . $client->id . '</a>';

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

    public function edit($id)
    {
        $data['booking'] = Booking::with('transhipment')->findOrFail($id);
        // echo "<pre>";
        // print_r($data['booking']);exit;
        $loggedInBranchId = Auth::user()->branch_user_id;
        $loggedInBranch = Branch::find($loggedInBranchId);
        $data['loggedInBranch'] = $loggedInBranch;
        $branchIds = DB::table('client_branch_map')
            ->where('client_id', $loggedInBranchId)
            ->where('status', 'ACTIVE')
            ->whereNull('deleted_at')
            ->pluck('branch_id');

        $data['clients'] = DB::table('client_branch_map')
            ->join('clients', 'clients.id', '=', 'client_branch_map.client_id')
            ->whereIn('client_branch_map.branch_id', $branchIds)
            ->where('client_branch_map.status', 'ACTIVE')
            ->whereNull('client_branch_map.deleted_at')
            ->select(
                'clients.id',
                DB::raw('MIN(clients.client_name) as client_name'),
                DB::raw('MIN(client_branch_map.branch_id) as branch_id')
            )
            ->groupBy('clients.id')
            ->get();

        $data['branch'] = Branch::all();
        $data['tittle'] = "Edit To Client Booking";
        $data['heading'] = 'Add New Booking';
        $data['listUrl'] = 'admin/booking/booking-list';


        // aur usko view mein bhej do
        return view('admin.booking.edit', $data);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_date' => 'required|date',
            'transhipmen_one' => 'nullable',
            'consignor_branch_id' => 'required|exists:branches,id',
            'transhipmen_two' => 'nullable',
            'consignee_branch_id' => 'required|exists:branches,id',
            'transhipment_three' => 'nullable',
            'actual_weight' => 'required',
            'cantain' => 'required',
            'aadhar_card' => 'nullable',
            'no_of_artical' => 'required|integer',
            'good_of_value' => 'required|numeric',
            'consignor_name' => 'required|string',
            'consignee_name' => 'required|string',
            'consignor_address' => 'required|string',
            'consignee_address' => 'required|string',
            'consignor_phone_number' => 'nullable|numeric',
            'consignee_phone_number' => 'required|numeric',
            'consignor_gst_number' => 'nullable|string',
            'consignee_gst_number' => 'nullable|string',
            'invoice_number' => 'nullable|string',
            'eway_bill_number' => 'nullable|string',
            'mark' => 'nullable|string',
            'remark' => 'nullable',
            'photo_id' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'parcel_image' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'distance' => 'nullable|numeric',
            'freight_amount' => 'nullable|numeric',
            'wbc_charges' => 'nullable|numeric',
            'handling_charges' => 'nullable|numeric',
            'fov_amount' => 'nullable|numeric',
            'fuel_amount' => 'nullable|numeric',
            'transhipmen_one_amount' => 'nullable',
            'transhipmen_two_amount' => 'nullable',
            'transhipment_three_amount' => 'nullable',
            'pickup_charges' => 'nullable|numeric',
            'hamali_Charges' => 'nullable|numeric',
            'bilti_Charges' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'compney_charges' => 'nullable|numeric',
            'sub_total' => 'nullable|numeric',
            'cgst' => 'nullable|numeric',
            'sgst' => 'nullable|numeric',
            'igst' => 'nullable|numeric',
            'grand_total' => 'nullable|numeric',
            'misc_charge_amount' => 'nullable|numeric',
            'grand_total_amount' => 'required|numeric',
            'booking_status' => 'required',
        ]);

        $validator->after(function ($validator) use ($request) {
            if ($request->consignor_branch_id == $request->consignee_branch_id) {
                $validator->errors()->add('consignor_branch_id', 'Consignor and consignee branches must be different.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $nextBiltiNumber = sHelper::generateNextBiltiNumber($request->booking_status);

        $onlyTranshipment = [
            'consignor_branch_id' => $request->consignor_branch_id,
            'transhipmen_one' => $request->transhipmen_one,
            'transhipmen_two' => $request->transhipmen_two,
            'transhipment_three' => $request->transhipment_three,
            'consignee_branch_id' => $request->consignee_branch_id
        ];

        try {
            $result = DB::transaction(function () use ($onlyTranshipment, $request, $nextBiltiNumber) {
                // Insert data into the bookings table
                $bookingId = DB::table('bookings')->insertGetId([
                    // Consignor
                    'bilti_number' => $nextBiltiNumber,
                    'booking_date' => $request->booking_date,
                    'consignor_branch_id' => $request->consignor_branch_id,
                    'consignor_name' => $request->consignor_name,
                    'consignor_address' => $request->consignor_address,
                    'consignor_phone_number' => $request->consignor_phone_number ?? '',
                    'consignor_email' => $request->consignor_email ?? '',
                    'consignor_gst_number' => $request->consignor_gst_number ?? '',
                    'invoice_number' => $request->invoice_number ?? '',
                    'eway_bill_number' => $request->eway_bill_number ?? '',
                    'mark' => $request->mark ?? '',
                    'remark' => $request->remark ?? '',
                    'photo_id' => $request->hasFile('photo_id') ? $request->file('photo_id')->store('photos', 'public') : 'NA',
                    'parcel_image' => $request->hasFile('parcel_image') ? $request->file('parcel_image')->store('parcels', 'public') : 'NA',
                    // Consignee
                    'consignee_branch_id' => $request->consignee_branch_id,
                    'consignee_name' => $request->consignee_name,
                    'consignee_address' => $request->consignee_address,
                    'consignee_phone_number' => $request->consignee_phone_number,
                    'consignee_gst_number' => $request->consignee_gst_number,
                    'consignee_email' => $request->consignee_email,

                    // Other Details
                    'no_of_artical' => $request->no_of_artical ?? 0,
                    'good_of_value' => $request->good_of_value ?? 0,
                    'cantain' => $request->cantain ?? 0,
                    'actual_weight' => $request->actual_weight ?? 0,
                    'aadhar_card' => $request->aadhar_card ?? 0,
                    'distance' => $request->distance ?? 0,
                    'freight_amount' => $request->freight_amount ?? 0,
                    'wbc_charges' => $request->wbc_charges ?? 0,
                    'handling_charges' => $request->handling_charges ?? 0,
                    'fov_amount' => $request->fov_amount ?? 0,
                    'fuel_amount' => $request->fuel_amount ?? 0,
                    'transhipmen_one_amount' => $request->transhipmen_one_amount ?? 0,
                    'transhipmen_two_amount' => $request->transhipmen_two_amount ?? 0,
                    'transhipment_three_amount' => $request->transhipment_three_amount ?? 0,
                    'pickup_charges' => $request->pickup_charges ?? 0,
                    'hamali_Charges' => $request->hamali_Charges ?? "0.00",
                    'bilti_Charges' => $request->bilti_Charges ?? "0.00",
                    'discount' => $request->discount ?? "0.00",
                    'compney_charges' => $request->compney_charges ?? 0,
                    'sub_total' => $request->sub_total ?? 0,
                    'cgst' => $request->cgst ?? 0.00,
                    'sgst' => $request->sgst ?? 0.00,
                    'igst' => $request->igst ?? 0.00,
                    'grand_total' => $request->grand_total ?: 0,
                    'misc_charge_amount' => $request->misc_charge_amount ?? 0,
                    'grand_total_amount' => $request->grand_total_amount,
                    'status' => Booking::BOOKED,
                    'booking_type' => $request->booking,
                    'manual_bilty_number' => $request->manual_bilty,
                    'client_id' => $request->client_id ?? null,
                    'created_at' => now(),
                    'booking_status' => $request->booking_status
                ]);

                $sequence = 1;
                foreach ($onlyTranshipment as $key => $value) {
                    if (!empty($value)) {
                        Transhipment::insert([
                            'booking_id' => $bookingId,
                            'from_transhipment' => $value,
                            'sequence_no' => $sequence,
                            'status' => ($sequence == 1) ? Transhipment::RECEIVED : Transhipment::PENDING,
                            'status' => ($sequence == 1) ? Transhipment::RECEIVED : Transhipment::PENDING,
                            'received_at' => ($sequence == 1) ? now() : NULL,
                            'type' => ($key == 'consignor_branch_id') ? Transhipment::TYPE_SENDER : (($key == 'consignee_branch_id') ? Transhipment::TYPE_RECEIVER : Transhipment::TYPE_TRANSHIPMENT),
                        ]);
                        $sequence++;
                    }
                }
                return [$bookingId];
            });
            [$bookingId] = $result;
            return redirect("admin/bookings/bilti/$bookingId")->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Booking created successfully', 'type' => 'success']
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with([
                    "alertMessage" => true,
                    "alert" => ['message' => 'An error occurred while processing your request. Please try again later', 'type' => 'danger']
                ]);
        }
    }
}
