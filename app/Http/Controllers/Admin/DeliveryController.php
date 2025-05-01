<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Branch;
class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.delivery.create');
    }
    public function list(Request $request)
    {

        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        $totalRecord = Booking::where('status', 3)->count();
        $bookingQuery = Booking::query();
        $bookingQuery->where('consignee_branch_id', Auth::user()->branch_user_id);
        // $bookingQuery->orWhere('consignee_branch_id', Auth::user()->branch_user_id);
        if ($search) {
            $bookingQuery->where('bilti_number', 'like', "%$search%")
                ->orWhere('consignor_name', 'like', "%$search%")
                ->orWhere('consignee_name', 'like', "%$search%");
        }
        $bookings = $bookingQuery->skip($start)->take($limit)->where('status', 3)->get();

        $rows = [];
        if ($bookings->count() > 0) {
            foreach ($bookings as $index => $booking) {
                // echo "<pre>";
                // print_r($booking->id);exit;
                $row = [];
                if ($request->bilti_list_type === 'challan') {
                    $row['sn'] = '<div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="bookingId[]" value="' . $booking->id . '">
                                            <label class="form-check-label" for="exampleCheck1"></label>
                                        </div>';
                } else {
                    $row['sn'] = $start + $index + 1; // Corrected SN to start from the current page's start index
                }

                $row['bilti_number'] = '<a href="' . route('bookings.bilti', ['id' => $booking->id]) . '" target="_blank">' . $booking->bilti_number . '</a>';

                $row['consignor_branch_id'] = $booking?->consignorBranch?->branch_name;
                $row['consignor_name'] = $booking->consignor_name;
                $row['address'] = $booking->consignor_address;
                $row['phone_number_1'] = $booking->consignor_phone_number;
                $row['gst_number'] = $booking->consignor_gst_number;
                $row['consignee_branch_id'] = $booking?->consigneeBranch?->branch_name;
                $row['consignee_name'] = $booking->consignee_name;
                $row['consignee_address'] = $booking->consignee_address;
                $row['consignee_phone_number_1'] = $booking->consignor_gst_number;
                $row['consignee_gst'] = $booking->consignee_gst_number;

                // Conditional logic for booking_type
                if ($booking->booking_type == 'Paid') {
                    $row['booking_type'] = 'Paid ';
                } elseif ($booking->booking_type == 'Topay') {
                    $row['booking_type'] = 'To Pay ';
                } else {
                    $row['booking_type'] = 'Unknown';
                }

                // Action column
                $row['action'] = ' <a href="' . url("admin/delivery/create/{$booking->id}") . '" class="btn btn-success">Ready to Deliver</a>';


                // Format the creation date
                $row['created_at'] = date('d-m-Y', strtotime($booking->created_at));


                // Append row to the array
                $rows[] = $row;
            }
        }


        // Prepare the JSON response with correct record counts
        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalRecord,
            "recordsFiltered" => $totalRecord, // Adjust this if you implement search/filter functionality
            "data" => $rows,
        ];

        return response()->json($json_data); // Return a JSON response
    }
    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'freight_charges' => 'required|numeric',
                'hamali_charges' => 'required|numeric',
                'demruge_charges' => 'required|numeric',
                'others_charges' => 'required|numeric',
                'grand_total' => 'required|numeric',
                'received_amount' => 'required|numeric',
                'pending_amount' => 'required|numeric',
                'parcel_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Added validation for image
            ]);

            // Handle image upload if present
            $imagePath = null;
            if ($request->hasFile('parcel_image')) {
                // Store the image in the 'public' directory
                $imagePath = $request->file('parcel_image')->store('parcel_images', 'public');
            }

            // Get the last delivery number from the delivery_numbers table
            $lastDelivery = DB::table('delivery_numbers')->orderBy('id', 'desc')->first();

            // If no previous delivery exists, start with DEL-001
            if ($lastDelivery) {
                // Generate the next serial number by incrementing the last serial number
                $serialNumber = 'DEL-' . str_pad((intval(substr($lastDelivery->delivery_number, 4)) + 1), 3, '0', STR_PAD_LEFT);
            } else {
                // If no deliveries exist, start with DEL-001
                $serialNumber = 'DEL-001';
            }

            // Insert the data into the delivery_receipts table
            $deliveryReceiptId = DB::table('delivery_receipts')->insertGetId([
                'booking_id' => $request->booking_id, // assuming booking_id is passed in the request
                'freight_charges' => $request->freight_charges,
                'hamali_charges' => $request->hamali_charges,
                'demruge_charges' => $request->demruge_charges,
                'others_charges' => $request->others_charges,
                'grand_total' => $request->grand_total,
                'received_amount' => $request->received_amount,
                'pending_amount' => $request->pending_amount,
                'delivery_number' => $serialNumber,
                'recived_by' => $request->recived_by,
                'reciver_mobile' => $request->reciver_mobile,
                'status' => 'Delivered', // or any default value you need
                'parcel_image' => $imagePath, // Store the image path
            ]);

            // Insert the serial number and booking_id into the delivery_numbers table
            DB::table('delivery_numbers')->insert([
                'delivery_number' => $serialNumber,
                'booking_id' => $request->booking_id,
                'status' => 1,  // Assuming 'status' 1 means active
            ]);

            // Update the booking's status to 4 (Delivered)
            DB::table('bookings')
                ->where('id', $request->booking_id) // Update the booking with the given booking_id
                ->update(['status' => 4]);

            // Redirect or send the ID as a response
            return redirect()->route('admin.delivery.receipt', ['id' => $deliveryReceiptId]);

        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;

            // Optionally, redirect back with an error message
            return redirect()->back()->with('error', 'There was an issue while saving the delivery receipt. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Fetch the delivery receipt data by ID
        $deliveryReceipt = DB::table('delivery_receipts')
            ->join('delivery_numbers', 'delivery_numbers.id', '=', 'delivery_receipts.id')
            ->join('bookings', 'delivery_receipts.booking_id', '=', 'bookings.id')
            ->join('branches as consignor_branch', 'bookings.consignor_branch_id', '=', 'consignor_branch.id')
            ->join('branches as consignee_branch', 'bookings.consignee_branch_id', '=', 'consignee_branch.id')
            ->where('delivery_receipts.id', $id)
            ->select(
                'delivery_receipts.*',
                'bookings.manual_bilty_number',
                'bookings.bilti_number',
                'bookings.consignor_name',
                'bookings.consignor_branch_id',
                'bookings.consignor_phone_number',
                'bookings.consignee_branch_id',
                'bookings.consignee_name',
                'bookings.consignee_phone_number',
                'bookings.no_of_artical',
                'bookings.no_of_artical',
                'bookings.actual_weight',
                'bookings.booking_type',
                'bookings.created_at as bookingDate',
                'delivery_numbers.delivery_number',
                'consignor_branch.branch_name as consignor_branch_name',
                'consignee_branch.branch_name as consignee_branch_name',

            )
            ->first();



        if (!$deliveryReceipt) {
            return redirect()->route('admin.delivery.deliverd.index')->with('error', 'Delivery receipt not found!');
        }
        // echo "<pre>";
        // print_r($deliveryReceipt);
        // exit;
        // Return the view with the delivery receipt data
        return view('admin.delivery.delivery-recipt', compact('deliveryReceipt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function create($id)
    {
        $data['booking'] = Booking::join('branches as consignor_branches', 'bookings.consignor_branch_id', '=', 'consignor_branches.id')
            ->join('branches as consignee_branches', 'bookings.consignee_branch_id', '=', 'consignee_branches.id')
            ->where('bookings.id', $id)
            ->select(
                'bookings.*',
                'consignor_branches.branch_name as consignor_branch_name',

                'consignee_branches.branch_name as consignee_branch_name',

            )
            ->first();
            // echo "<pre>";
            // print_r($data['booking']);exit;
        return view('admin.delivery.deliver', $data);
    }


}
