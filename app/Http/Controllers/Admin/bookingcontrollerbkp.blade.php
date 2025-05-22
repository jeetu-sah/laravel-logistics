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

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function incomingLoad()
    {
        $data['title'] = 'Incoimg Load';
        return view('admin.booking.incomingLoad', $data);
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
        $bookingQuery = Booking::query();

        // Joining the clients table
        $bookingQuery->join('clients', 'clients.id', '=', 'bookings.client_id');

        // Filter by branch
        $bookingQuery->where('consignor_branch_id', Auth::user()->branch_user_id);
        $bookingQuery->select(
            'bookings.id as booking_id',
            'bookings.bilti_number',
            'bookings.manual_bilty_number',
            'bookings.consignor_name',
            'bookings.manual_bilty_number',
            'bookings.booking_type',
            'clients.client_name as client_name',
            'clients.client_address as client_address',
            'bookings.consignor_branch_id',
            'bookings.consignee_branch_id',
            'bookings.consignor_address',
            // add any other required columns here
        );
        // Search functionality
        if ($search) {
            $bookingQuery->where('bilti_number', 'like', "%$search%")
                ->orWhere('consignor_name', 'like', "%$search%")
                ->orWhere('consignee_name', 'like', "%$search%")
                ->orWhere('clients.client_name', 'like', "%$search%"); // Added client name search
        }

        // Status filter
        // $bookingQuery->where('bookings.status', Booking::BOOKED);

        // Count the total records
        $totalRecord = $bookingQuery->count();

        // Apply pagination and order
        $bookings = $bookingQuery->skip($start)->take($limit)->orderBy('bookings.created_at', 'desc')->get();
        // echo "<pre>";
        // print_r($bookings);exit;
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
                $row['bilti_number'] = '<a href="' . route('bookings.bilti', ['id' => $booking->booking_id]) . '" target="_blank">' . $booking->bilti_number . '</a>';
                $row['offline_bilti'] = $booking->manual_bilty_number
                    ? '<a href="' . route('bookings.bilti', ['id' => $booking->booking_id]) . '" target="_blank">' . $booking->manual_bilty_number . '</a>'
                    : 'N/A';

                // Consignor and consignee information
                $row['consignor_branch_id'] = $booking?->consignorBranch?->branch_name ?? 'N/A';
                $row['consignor_name'] = $booking->consignor_name ?? 'N/A';
                $row['address'] = $booking->consignor_address ?? 'N/A';
                $row['phone_number_1'] = $booking->phone_number_1 ?? 'N/A';
                $row['gst_number'] = $booking->gst_number ?? 'N/A';
                $row['consignee_branch_id'] = $booking?->consigneeBranch?->branch_name ?? 'N/A';
                $row['consignee_name'] = $booking->client_name;
                $row['consignee_address'] = $booking->client_address;
                $row['consignee_phone_number_1'] = $booking->client_phone_number;

                // Booking type
                if ($booking->booking_type == 'Paid') {
                    $row['booking_type'] = 'Paid ';
                } elseif ($booking->booking_type == 'Topay') {
                    $row['booking_type'] = 'To Pay ';
                } elseif ($booking->booking_type == 3) {
                    $row['booking_type'] = 'Client ';
                } else {
                    $row['booking_type'] = 'Unknown';
                }

                // Actions (Edit and Print)
                $row['action'] = '<a href="' . url("admin/clients/bookings/edit/{$booking->booking_id}") . '" class="btn btn-primary">Edit</a>&nbsp;<a href="' . url("admin/bookings/bilti/{$booking->booking_id}") . '" class="btn btn-warning">Print</a>';

                // Date formatting
                $row['created_at'] = date('d-m-Y', strtotime($booking->created_at));

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

    public function upcomingBookings(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        $bookingQuery = Booking::query();

        $bookingQuery->where('consignee_branch_id', Auth::user()->branch_user_id)->orWhere('transhipmen_one', Auth::user()->branch_user_id)->orWhere('transhipmen_two', Auth::user()->branch_user_id)->orWhere('transhipment_three', Auth::user()->branch_user_id);
        if ($search) {
            $bookingQuery->where('bilti_number', 'like', "%$search%")
                ->orWhere('consignor_name', 'like', "%$search%")
                ->orWhere('consignee_name', 'like', "%$search%");
        }
        $bookingQuery->where('status', 1);  // Only Pending bookings

        $totalRecord = $bookingQuery->count();

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
                $row['phone_number_1'] = $booking->consignor_phone_number;
                $row['gst_number'] = $booking->consignor_gst_number;
                $row['consignee_branch_id'] = $booking?->consigneeBranch?->branch_name;
                $row['consignee_name'] = $booking->consignee_name;
                $row['consignee_address'] = $booking->consignee_address;
                $row['consignee_phone_number_1'] = $booking->consignee_phone_number;

                // Booking Type
                if ($booking->booking_type == 'Paid') {
                    $row['booking_type'] = 'Paid';
                } elseif ($booking->booking_type == 'Topay') {
                    $row['booking_type'] = 'To Pay';
                } elseif ($booking->booking_type == 'Toclient') {
                    $row['booking_type'] = 'Client';
                } else {
                    $row['booking_type'] = 'Unknown';
                }

                // Adding Transhipment Amounts (showing each transhipment charge)
                $row['transhipment_one_amount'] = $booking->transhipmen_one_amount;
                $row['transhipment_two_amount'] = $booking->transhipmen_two_amount;
                $row['transhipment_three_amount'] = $booking->transhipment_three_amount;

                // Action for updating status
                $row['action'] = '<button class="btn btn-success" onclick="updateBookingStatus(' . $booking->id . ')">Receive Maal</button>';

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

    public function create(Request $request)
    {
        // Get the current authenticated user
        $data['user'] = auth()->user();

        // Get all branches
        $data['branch'] = Branch::all();

        // Set the title for the page
        $data['tittle'] = "Create New Booking";

        // Check if the "no-bill-bookings" query parameter is present
        // It will return the value of the query parameter (or null if it doesn't exist)
        $data['noBillBookings'] = $request->query('no-bill-bookings'); // true, false or null

        // Return the view with the data
        return view('admin.booking.create', $data);
    }




    public function challanBookingList(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        $userBranchId = Auth::user()->branch_user_id;

        $bookingQuery = Booking::with(['client']);
        // $bookingQuery->join('clients', 'clients.id', '=', 'bookings.client_id');
        //->join('transhipments', 'transhipments.booking_id', '=', 'bookings.id')
        // ->select(
        //     'bookings.id as booking_id',
        //     'bookings.bilti_number',
        //     'bookings.consignor_name',
        //     'bookings.manual_bilty_number',
        //     'bookings.booking_type',
        //     'clients.client_name as client_name',
        //     'clients.client_address as client_address',
        //     'bookings.consignor_branch_id',
        // );

        // Add the filtering conditions
        // $bookingQuery->where(function ($q) {
        //     $q->where('transhipments.status', 'received')
        //         ->orWhere('bookings.status', '!=', 2); // Ensures booking is not in status 2
        // });

        // Filter by branch, checking both consignor branch and transhipment to branch
        // $bookingQuery->where(function ($query) use ($userBranchId) {
        //     $query->where('bookings.consignor_branch_id', $userBranchId);
        //        // ->orWhere('transhipments.to_transhipment', $userBranchId);
        // });
        if ($search) {
            $bookingQuery->where('bilti_number', 'like', "%$search%")
                ->orWhere('consignor_name', 'like', "%$search%")
                ->orWhere('consignee_name', 'like', value: "%$search%")
                ->orWhere('clients.client_name', 'like', "%$search%"); // Added client name search
        }
        $totalRecord = $bookingQuery->count();
        // Apply 'whereNotExists' condition to exclude bookings already in 'loading_challan_booking'
        $bookingQuery->whereExists(function ($query) use ($userBranchId) {
            $query->select(DB::raw('1'))
                ->from('transhipments')
                ->whereRaw("transhipments.from_transhipment = $userBranchId AND received_at IS NOT NULL AND dispatched_at IS NULL");
        });
        // $bookingQuery->whereNotExists(function ($query) {
        //     $query->select(DB::raw('1'))
        //         ->from('loading_challan_booking')
        //         ->whereRaw('loading_challan_booking.booking_id = bookings.id');
        // });

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
                $row['consignor_name'] = $booking->consignor_name;

                $row['phone_number_1'] = $booking->consignor_phone_number;
                $row['gst_number'] = $booking->gst_number;

                // Consignee details
                $row['consignee_branch_id'] = $booking?->consigneeBranch?->branch_name;
                $row['consignee_name'] = $booking->client_name;

                $row['consignee_branch_id'] = $booking->client_address;
                $row['consignee_phone_number_1'] = $booking->consignee_phone_number;

                // Conditional logic for 'booking_type'
                $row['booking_type'] = match ($booking->booking_type) {
                    'Paid' => 'Paid',
                    'Topay' => 'To Pay',
                    default => 'Unknown',
                };

                // Action buttons (Edit and Print)
                $row['action'] = '<a href="' . url("admin/bookings/edit/{$booking->id}") . '" class="btn btn-primary">Edit</a>&nbsp;
                                  <a href="' . url("admin/bookings/bilti/{$booking->id}") . '" class="btn btn-warning">Print</a>';

                // Created timestamp
                $row['created_at'] = Carbon::parse($booking->created_at)->format('d/m/Y h:i:s');
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

    private function noBillgenerateBiltiNumber($lastBiltiNumber): string
    {
        // Check if the last bilti number is provided and valid
        if (!empty($lastBiltiNumber) && preg_match('/\d+/', $lastBiltiNumber, $matches)) {
            // Extract the numeric part from the last bilti number
            $lastNumber = (int) $matches[0];
            $nextNumber = $lastNumber + 1;
        } else {
            // If no last bilti number exists, start from 1
            $nextNumber = 1;
        }

        // Return the bilti number in the format of YYMMxxx (e.g., 250131001)
        return 'NB-' . date('y') . date('m') . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }


    public function bilti($id)
    {
        $data['booking'] = Booking::with(['client', 'transhipments'])->findOrFail($id);
        $branchCode1 = $data['booking']->consignor_branch_id;
        $branchCode2 = $data['booking']->consignee_branch_id;
        $branch1 = Branch::find($branchCode1);
        $branch2 = Branch::find($branchCode2);
        $data['consignorAddress'] = $branch1->address1;
        $data['consignorCity'] = $branch1->branch_name;
        $data['consigneeCity'] = $branch2->branch_name;
        $data['branch1Contact'] = $branch1->contact;
        $data['branch2Contact'] = $branch2->contact;
        $transhipments = $data['booking']->transhipments;
        if ($transhipments->isEmpty()) {
            $transhipments = collect([
                (object) [
                    'from_transhipment' => $branch1->branch_name,
                    'to_transhipment' => $branch2->branch_name,
                    'sequence_no' => 1
                ]
            ]);
        }
        $data['client'] = $data['booking']->client;
        $data['transhipments'] = $transhipments;
        foreach ($data['transhipments'] as $transhipment) {
            $transhipment->from_transhipment_name = Branch::find($transhipment->from_transhipment)->branch_name ?? 'NA';
            $transhipment->to_transhipment_name = Branch::find($transhipment->to_transhipment)->branch_name ?? 'NA';
        }

        // Return the view with data
        return view('admin.booking.bilti', $data);
    }


    public function to_client_booking_save(Request $request)
    {
       
        if ($request->consignor_branch_id == $request->consignee_branch_id) {
            return redirect()->back()->withInput()->with(['error' => 'Consignor and consignee branches must be different.'])->withInput();
        }
        $nextBiltiNumber = sHelper::generateNextBiltiNumber();
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
                    'consignor_phone_number' => $request->consignor_phone_number ?: "NA",
                    'consignor_email' => $request->consignor_email ?: "NA",
                    'consignor_gst_number' => $request->consignor_gst_number ?: "NA",
                    'invoice_number' => $request->invoice_number ?: "NA",
                    'eway_bill_number' => $request->eway_bill_number ?: "NA",
                    'mark' => $request->mark ?: "NA",
                    'remark' => $request->remark ?: "NA",
                    'photo_id' => $request->hasFile('photo_id') ? $request->file('photo_id')->store('photos', 'public') : 'NA',
                    'parcel_image' => $request->hasFile('parcel_image') ? $request->file('parcel_image')->store('parcels', 'public') : 'NA',
                    // Consignee
                    'consignee_branch_id' => $request->consignee_branch_id,

                    // Other Details
                    'no_of_artical' => $request->no_of_artical,
                    'good_of_value' => $request->good_of_value,
                    'cantain' => $request->cantain ?: "0.00",
                    'actual_weight' => $request->actual_weight ?: "0.00",
                    'aadhar_card' => $request->aadhar_card ?: "0.00",
                    'distance' => $request->distance ?: "0.00",
                    'freight_amount' => $request->freight_amount ?: "0.00",
                    'wbc_charges' => $request->wbc_charges ?: "0.00",
                    'handling_charges' => $request->handling_charges ?: "0.00",
                    'fov_amount' => $request->fov_amount ?: "0.00",
                    'fuel_amount' => $request->fuel_amount ?: "0.00",
                    'transhipmen_one_amount' => $request->transhipmen_one_amount ?: "0.00",
                    'transhipmen_two_amount' => $request->transhipmen_two_amount ?: "0.00",
                    'transhipment_three_amount' => $request->transhipment_three_amount ?: "0.00",
                    'pickup_charges' => $request->pickup_charges ?: "0.00",
                    'hamali_Charges' => $request->hamali_Charges ?: "0.00",
                    'bilti_Charges' => $request->bilti_Charges ?: "0.00",
                    'discount' => $request->discount ?: "0.00",
                    'compney_charges' => $request->compney_charges ?: "0.00",
                    'sub_total' => $request->sub_total ?: "0.00",
                    'cgst' => $request->cgst ?: "0.00",
                    'sgst' => $request->sgst ?: "0.00",
                    'igst' => $request->igst ?: "0.00",
                    'grand_total' => $request->grand_total ?: "0.00",
                    'misc_charge_amount' => $request->misc_charge_amount ?: "0.00",
                    'grand_total_amount' => $request->grand_total_amount,
                    'status' => '1',
                    'booking_type' => $request->booking,
                    'manual_bilty_number' => $request->manual_bilty,
                    'client_id' => $request->client_id,
                    'created_at' => now(),
                ]);

                $sequence = 1;
                foreach ($onlyTranshipment as $key => $value) {
                    if (!empty($value)) {
                        Transhipment::insert([
                            'booking_id' => $bookingId,
                            'from_transhipment' => $value,
                            'sequence_no' => $sequence,
                            'status' => ($sequence == 1) ? Transhipment::RECEIVED : Transhipment::PENDING,
                            'received_at' => ($sequence == 1) ? now() : NULL,
                        ]);
                        $sequence++;
                    }
                }
                return [$bookingId];
            });
            [$bookingId] = $result;
            // Redirect to the booking bilti page
            return redirect()->route('bookings.bilti', ['id' => $bookingId]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'An error occurred while processing your request. Please try again later.'])->withInput();
        }
    }

    public function to_client_booking(Request $request)
    {
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
        $data['tittle'] = "To Client Booking";
        $data['heading'] = 'Add New Booking';
        $data['listUrl'] = 'admin/booking/booking-list';

        return view('admin.booking.create-to-client-booking', $data);
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
        $noBillBookings = $request->query('no-bill-bookings');
        try {
            $request->validate([
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
                // Consignee
                'consignor_name' => 'required|string',
                'consignee_name' => 'required|string',
                'consignor_address' => 'required|string',
                'consignee_address' => 'required|string',
                'consignor_phone_number' => 'nullable|string',
                'consignee_phone_number' => 'required|string',
                'consignor_gst_number' => 'nullable|string',
                'consignee_gst_number' => 'nullable|string',
                'consignor_email' => 'nullable|email',
                'consignee_email' => 'nullable|email',
                // Other Details
                'invoice_number' => 'nullable|string',
                'eway_bill_number' => 'nullable|string',
                'mark' => 'nullable|string',
                'remark' => 'nullable',
                'photo_id' => 'nullable|file|mimes:jpg,jpeg,png,pdf', // Add validation as needed
                'parcel_image' => 'nullable|file|mimes:jpg,jpeg,png,pdf', // Add validation as needed

                // Invoice details
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
                'booking' => 'required',
                'manual_bilty' => 'nullable',
                'client_id' => 'nullable',
            ]);

            // Check for matching consignor and consignee branch IDs
            if ($request->consignor_branch_id == $request->consignee_branch_id) {
                return redirect()->back()->with(['error' => 'Consignor and consignee branches must be different.'])->withInput();
            }

            // Generate bilti_number
            $lastBilti = DB::table('bookings')->latest('id')->value('id');
            if ($noBillBookings) {
                // If no-bill-bookings is set, use "NB" format
                $nextBiltiNumber = $this->noBillgenerateBiltiNumber($lastBilti); // Example: NB00001
            } else {
                // If no-bill-bookings is not set, use regular bilti number generation logic
                $nextBiltiNumber = $this->generateBiltiNumber($lastBilti);  // Your existing bilti generation function
            }

            $bookingId = DB::table('bookings')->insertGetId([
                // Consignor
                'bilti_number' => $nextBiltiNumber,
                'booking_date' => $request->booking_date,
                'consignor_branch_id' => $request->consignor_branch_id,
                'consignor_name' => $request->consignor_name,
                'consignor_address' => $request->consignor_address,
                'consignor_phone_number' => $request->consignor_phone_number ?: "NA",
                'consignor_email' => $request->consignor_email ?: "NA",
                'consignor_gst_number' => $request->consignor_gst_number ?: "NA",
                'invoice_number' => $request->invoice_number ?: "NA",
                'eway_bill_number' => $request->eway_bill_number ?: "NA",
                'mark' => $request->mark ?: "NA",
                'remark' => $request->remark ?: "NA",
                'photo_id' => $request->hasFile('photo_id') ? $request->file('photo_id')->store('photos', 'public') : 'NA',
                'parcel_image' => $request->hasFile('parcel_image') ? $request->file('parcel_image')->store('parcels', 'public') : 'NA',


                // Consignee
                'consignee_branch_id' => $request->consignee_branch_id,
                'consignee_name' => $request->consignee_name,
                'consignee_address' => $request->consignee_address,
                'consignee_phone_number' => $request->consignee_phone_number,
                'consignee_email' => $request->consignee_email ?: "NA",
                'consignee_gst_number' => $request->consignee_gst_number ?: "NA",
                // Other Details
                'no_of_artical' => $request->no_of_artical,
                'good_of_value' => $request->good_of_value,
                'transhipmen_one' => $request->transhipmen_one ?: "",
                'transhipmen_two' => $request->transhipmen_two ?: "",
                'transhipment_three' => $request->transhipment_three ?: "",
                'cantain' => $request->cantain ?: "0.00",
                'actual_weight' => $request->actual_weight ?: "0.00",
                'aadhar_card' => $request->aadhar_card ?: "0.00",
                'distance' => $request->distance ?: "0.00",
                'freight_amount' => $request->freight_amount ?: "0.00",
                'wbc_charges' => $request->wbc_charges ?: "0.00",
                'handling_charges' => $request->handling_charges ?: "0.00",
                'fov_amount' => $request->fov_amount ?: "0.00",
                'fuel_amount' => $request->fuel_amount ?: "0.00",
                'transhipmen_one_amount' => $request->transhipmen_one_amount ?: "0.00",
                'transhipmen_two_amount' => $request->transhipmen_two_amount ?: "0.00",
                'transhipment_three_amount' => $request->transhipment_three_amount ?: "0.00",
                'pickup_charges' => $request->pickup_charges ?: "0.00",
                'hamali_Charges' => $request->hamali_Charges ?: "0.00",
                'bilti_Charges' => $request->bilti_Charges ?: "0.00",
                'discount' => $request->discount ?: "0.00",
                'compney_charges' => $request->compney_charges ?: "0.00",
                'sub_total' => $request->sub_total ?: "0.00",
                'cgst' => $request->cgst ?: "0.00",
                'sgst' => $request->sgst ?: "0.00",
                'igst' => $request->igst ?: "0.00",
                'grand_total' => $request->grand_total ?: "0.00",
                'misc_charge_amount' => $request->misc_charge_amount ?: "0.00",
                'grand_total_amount' => $request->grand_total_amount,
                'status' => '1',
                'booking_type' => $request->booking,
                'manual_bilty_number' => $request->manual_bilty,
                'client_id' => $request->client_id,
                'created_at' => now(),
            ]);

            // Redirect to the booking bilti page
            // Assuming after inserting the booking, you have the $bookingId
            return redirect()->route('bookings.bilti', ['id' => $bookingId])->with('bookingId', $bookingId);
        } catch (\Exception $e) {

            echo $e->getMessage();
            exit;

            // Redirect back with an error message
            return redirect()->back()->with(['error' => 'An error occurred while processing your request. Please try again later.'])->withInput();
        }
    }
}
