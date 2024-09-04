<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bookings;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['branch'] = Branch::all();

        $data['heading']  = 'Add New Booking';
        $data['listUrl'] = 'admin/booking/booking-list';
        // $data['states'] =  DB::table('states')->get();

        return view('admin.booking.create-paid-booking', $data);
    }

    public function to_pay_booking()
    {
        $data['branch'] = Branch::all();

        $data['heading']  = 'Add New Booking';
        $data['listUrl'] = 'admin/booking/booking-list';
        // $data['states'] =  DB::table('states')->get();

        return view('admin.booking.create-to-pay-booking', $data);
    }

    public function to_client_booking()
    {
        $data['branch'] = Branch::all();

        $data['heading']  = 'Add New Booking';
        $data['listUrl'] = 'admin/booking/booking-list';
        // $data['states'] =  DB::table('states')->get();

        return view('admin.booking.create-to-client-booking', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function paid_booking(Request $request)
    {
        $request->validate([
            'consignor_branch_id' => 'nullable|exists:branches,id',
            'consignor_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone_number_1' => 'nullable|string|max:255',
            'phone_number_2' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'gst_number' => 'nullable|string|max:255',
            'pin_code' => 'nullable|string|max:10',
            'consignee_branch_id' => 'nullable|exists:branches,id',
            'consignee_name' => 'nullable|string|max:255',
            'consignee_address' => 'nullable|string',
            'consignee_phone_number_1' => 'nullable|string|max:255',
            'consignee_phone_number_2' => 'nullable|string|max:255',
            'consignee_email' => 'nullable|email|max:255',
            'consignee_gst_number' => 'nullable|string|max:255',
            'consignee_pin_code' => 'nullable|string|max:10',
            'dest_pin_code' => 'nullable|string|max:10',
            'services_line' => 'nullable|string|max:255',
            'no_of_pkg' => 'nullable|integer',
            'actual_weight' => 'nullable|string',
            'gateway' => 'nullable|string|max:255',
            'packing_type' => 'nullable|string|max:255',
            'freight_amount' => 'nullable|numeric',
            'os_amount' => 'nullable|numeric',
            'fov_amount' => 'nullable|numeric',
            'transhipment_amount' => 'nullable|numeric',
            'handling_charge_amount' => 'nullable|numeric',
            'loading_charge_amount' => 'nullable|numeric',
            'misc_charge_amount' => 'nullable|numeric',
            'other_charge_amount' => 'nullable|numeric',
            'grand_total_amount' => 'nullable|numeric',
        ]);

        // Insert into the database
        DB::table('bookings')->insert([
            'consignor_branch_id' => $request->consignor_branch_id,
            'consignor_name' => $request->consignor_name,
            'address' => $request->address,
            'phone_number_1' => $request->phone_number_1,
            'phone_number_2' => $request->phone_number_2,
            'email' => $request->email,
            'gst_number' => $request->gst_number,
            'pin_code' => $request->pin_code,
            'consignee_branch_id' => $request->consignee_branch_id,
            'consignee_name' => $request->consignee_name,
            'consignee_address' => $request->consignee_address,
            'consignee_phone_number_1' => $request->consignee_phone_number_1,
            'consignee_phone_number_2' => $request->consignee_phone_number_2,
            'consignee_email' => $request->consignee_email,
            'consignee_gst_number' => $request->consignee_gst_number,
            'consignee_pin_code' => $request->consignee_pin_code,
            'dest_pin_code' => $request->dest_pin_code,
            'services_line' => $request->services_line,
            'no_of_pkg' => $request->no_of_pkg,
            'actual_weight' => $request->actual_weight,
            'gateway' => $request->gateway,
            'packing_type' => $request->packing_type,
            'freight_amount' => $request->freight_amount,
            'os_amount' => $request->os_amount,
            'fov_amount' => $request->fov_amount,
            'transhipment_amount' => $request->transhipment_amount,
            'handling_charge_amount' => $request->handling_charge_amount,
            'loading_charge_amount' => $request->loading_charge_amount,
            'misc_charge_amount' => $request->misc_charge_amount,
            'other_charge_amount' => $request->other_charge_amount,
            'grand_total_amount' => $request->grand_total_amount,
            'booking_type' => 1, // Paid booking type
            'status' => 1,
        ]);

        return redirect()->route('booking.create')->with('success', 'Paid booking saved successfully!');
    }

    public function to_pay_booking_save(Request $request)
    {
        $request->validate([
            'consignor_branch_id' => 'nullable|exists:branches,id',
            'consignor_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone_number_1' => 'nullable|string|max:255',
            'phone_number_2' => 'nullable|string|max:255',
            'gst_number' => 'nullable|string|max:255',
            'pin_code' => 'nullable|string|max:10',
            'consignee_branch_id' => 'nullable|exists:branches,id',
            'consignee_name' => 'nullable|string|max:255',
            'consignee_address' => 'nullable|string',
            'consignee_phone_number_1' => 'nullable|string|max:255',
            'consignee_phone_number_2' => 'nullable|string|max:255',
            'consignee_gst_number' => 'nullable|string|max:255',
            'consignee_pin_code' => 'nullable|string|max:10',
            'dest_pin_code' => 'nullable|string|max:10',
            'services_line' => 'nullable|string|max:255',
            'no_of_pkg' => 'nullable|integer',
            'actual_weight' => 'nullable|string',
            'gateway' => 'nullable|string|max:255',
            'packing_type' => 'nullable|string|max:255',
            'freight_amount' => 'nullable|numeric',
            'os_amount' => 'nullable|numeric',
            'fov_amount' => 'nullable|numeric',
            'transhipment_amount' => 'nullable|numeric',
            'handling_charge_amount' => 'nullable|numeric',
            'loading_charge_amount' => 'nullable|numeric',
            'misc_charge_amount' => 'nullable|numeric',
            'other_charge_amount' => 'nullable|numeric',
            'grand_total_amount' => 'nullable|numeric',
        ]);

        // Insert into the database
        DB::table('bookings')->insert([
            'consignor_branch_id' => $request->consignor_branch_id,
            'consignor_name' => $request->consignor_name,
            'address' => $request->address,
            'phone_number_1' => $request->phone_number_1,
            'phone_number_2' => $request->phone_number_2,
            'email' => $request->email,
            'gst_number' => $request->gst_number,
            'pin_code' => $request->pin_code,
            'consignee_branch_id' => $request->consignee_branch_id,
            'consignee_name' => $request->consignee_name,
            'consignee_address' => $request->consignee_address,
            'consignee_phone_number_1' => $request->consignee_phone_number_1,
            'consignee_phone_number_2' => $request->consignee_phone_number_2,
            'consignee_email' => $request->consignee_email,
            'consignee_gst_number' => $request->consignee_gst_number,
            'consignee_pin_code' => $request->consignee_pin_code,
            'dest_pin_code' => $request->dest_pin_code,
            'services_line' => $request->services_line,
            'no_of_pkg' => $request->no_of_pkg,
            'actual_weight' => $request->actual_weight,
            'gateway' => $request->gateway,
            'packing_type' => $request->packing_type,
            'freight_amount' => $request->freight_amount,
            'os_amount' => $request->os_amount,
            'fov_amount' => $request->fov_amount,
            'transhipment_amount' => $request->transhipment_amount,
            'handling_charge_amount' => $request->handling_charge_amount,
            'loading_charge_amount' => $request->loading_charge_amount,
            'misc_charge_amount' => $request->misc_charge_amount,
            'other_charge_amount' => $request->other_charge_amount,
            'grand_total_amount' => $request->grand_total_amount,
            'booking_type' => 2,
            'status' => 1,
        ]);

        return redirect()->route('booking.create')->with('success', 'To-Pay booking saved successfully!');
    }



    public function to_client_booking_save(Request $request)
    {
        $request->validate([
            'consignor_branch_id' => 'nullable|exists:branches,id',
            'consignor_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone_number_1' => 'nullable|string|max:255',
            'phone_number_2' => 'nullable|string|max:255',
            'gst_number' => 'nullable|string|max:255',
            'pin_code' => 'nullable|string|max:10',
            'consignee_branch_id' => 'nullable|exists:branches,id',
            'consignee_name' => 'nullable|string|max:255',
            'consignee_address' => 'nullable|string',
            'consignee_phone_number_1' => 'nullable|string|max:255',
            'consignee_phone_number_2' => 'nullable|string|max:255',
            'consignee_gst_number' => 'nullable|string|max:255',
            'consignee_pin_code' => 'nullable|string|max:10',
            'dest_pin_code' => 'nullable|string|max:10',
            'services_line' => 'nullable|string|max:255',
            'no_of_pkg' => 'nullable|integer',
            'actual_weight' => 'nullable|string',
            'gateway' => 'nullable|string|max:255',
            'packing_type' => 'nullable|string|max:255',
            'freight_amount' => 'nullable|numeric',
            'os_amount' => 'nullable|numeric',
            'fov_amount' => 'nullable|numeric',
            'transhipment_amount' => 'nullable|numeric',
            'handling_charge_amount' => 'nullable|numeric',
            'loading_charge_amount' => 'nullable|numeric',
            'misc_charge_amount' => 'nullable|numeric',
            'other_charge_amount' => 'nullable|numeric',
            'grand_total_amount' => 'nullable|numeric',
        ]);

        // Insert into the database
        DB::table('bookings')->insert([
            'consignor_branch_id' => $request->consignor_branch_id,
            'consignor_name' => $request->consignor_name,
            'address' => $request->address,
            'phone_number_1' => $request->phone_number_1,
            'phone_number_2' => $request->phone_number_2,
            'email' => $request->email,
            'gst_number' => $request->gst_number,
            'pin_code' => $request->pin_code,
            'consignee_branch_id' => $request->consignee_branch_id,
            'consignee_name' => $request->consignee_name,
            'consignee_address' => $request->consignee_address,
            'consignee_phone_number_1' => $request->consignee_phone_number_1,
            'consignee_phone_number_2' => $request->consignee_phone_number_2,
            'consignee_email' => $request->consignee_email,
            'consignee_gst_number' => $request->consignee_gst_number,
            'consignee_pin_code' => $request->consignee_pin_code,
            'dest_pin_code' => $request->dest_pin_code,
            'services_line' => $request->services_line,
            'no_of_pkg' => $request->no_of_pkg,
            'actual_weight' => $request->actual_weight,
            'gateway' => $request->gateway,
            'packing_type' => $request->packing_type,
            'freight_amount' => $request->freight_amount,
            'os_amount' => $request->os_amount,
            'fov_amount' => $request->fov_amount,
            'transhipment_amount' => $request->transhipment_amount,
            'handling_charge_amount' => $request->handling_charge_amount,
            'loading_charge_amount' => $request->loading_charge_amount,
            'misc_charge_amount' => $request->misc_charge_amount,
            'other_charge_amount' => $request->other_charge_amount,
            'grand_total_amount' => $request->grand_total_amount,
            'booking_type' => 3,
            'status' => 1,
        ]);

        return redirect()->route('booking.create')->with('success', 'Client booking saved successfully!');
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function list(Request $request)
    {
        $limit = $request->input('length', 10); // Default to 10 if 'length' is not provided
        $start = $request->input('start', 0);   // Default to 0 if 'start' is not provided

        // Get total record count
        $totalRecord = Bookings::count(); // Simplified to directly get the count

        // Create a query builder instance and apply pagination
        $booking = Bookings::skip($start)->take($limit)->get();

        $rows = [];
        if ($booking->count() > 0) {
            foreach ($booking as $index => $branch) {
                $row = [];
                $row['sn'] = $start + $index + 1; // Corrected SN to start from the current page's start index
                $row['branch_name'] = $branch->branch_name;
                $row['branch_code'] = '<a href="' . url("admin/branches/edit/{$branch->id}") . '">' . $branch->branch_code . '</a>';
                $row['owner_name'] = $branch->owner_name;
                $row['contact'] = $branch->contact;
                $row['gst'] = $branch->gst;
                $row['user_status'] = $branch->user_status;
                $row['action'] = '<a href="' . url("admin/branches/edit/{$branch->id}") . '" class="btn btn-primary">Edit</a>';
                $row['created_at'] = Carbon::parse($branch->created_at)->format('d/m/Y');

                $rows[] = $row;
            }
        }

        // Prepare the JSON response with correct record counts
        $json_data = [
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => $totalRecord,
            "recordsFiltered" => $totalRecord, // Adjust this if you implement search/filter functionality
            "data"            => $rows,
        ];

        return response()->json($json_data); // Return a JSON response
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bookings $Bookings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bookings $Bookings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bookings $Bookings)
    {
        //
    }
}
