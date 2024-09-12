<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
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
        $data['title'] = 'Bookings';
        return view('admin.booking.booking-list', $data);
    }
    public function list(Request $request)
    {
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        $totalRecord = Booking::count();
        $booking = Booking::skip($start)->take($limit)->get();

        $rows = [];
        if ($booking->count() > 0) {
            foreach ($booking as $index => $bookings) {
                $row = [];
                $row['sn'] = $start + $index + 1; // Corrected SN to start from the current page's start index
                $row['consignor_branch_id'] = $bookings->consignor_branch_id;
                $row['consignor_name'] = $bookings->consignor_name;
                $row['address'] = $bookings->address;
                $row['phone_number_1'] = $bookings->phone_number_1;
                $row['gst_number'] = $bookings->gst_number;
                $row['consignee_branch_id'] = $bookings->consignee_branch_id;
                $row['consignee_name'] = $bookings->consignee_name;
                $row['consignee_address'] = $bookings->consignee_address;
                $row['consignee_phone_number_1'] = $bookings->consignee_phone_number_1;

                // Conditional logic for booking_type
                if ($bookings->booking_type == 1) {
                    $row['booking_type'] = 'Paid Booking';
                } elseif ($bookings->booking_type == 2) {
                    $row['booking_type'] = 'To Pay Booking';
                } elseif ($bookings->booking_type == 3) {
                    $row['booking_type'] = 'Client Booking';
                } else {
                    $row['booking_type'] = 'Unknown'; // In case a different value is present
                }

                // Action column
                $row['action'] = '<a href="' . url("admin/bookings/edit/{$bookings->id}") . '" class="btn btn-primary">Edit</a>';

                // Format the creation date
                $row['created_at'] = Carbon::parse($bookings->created_at)->format('d/m/Y');

                // Append row to the array
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
    public function bookings()
    {
        $data['branch'] = Branch::all();

        $data['heading']  = 'Add New Booking';
        $data['listUrl'] = 'admin/booking/booking-list';
        // $data['states'] =  DB::table('states')->get();

        return view('admin.booking.create-paid-booking', $data);;
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
    // public function booking()
    // {


    //     return view('admin.booking.booking-list');
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a paid_booking in storage.
     */
    public function paid_booking(Request $request)
    {

        $request->validate([
            'consignor_branch_id' => 'required',
            'consignor_name' => 'required',
            'address' => 'required',
            'phone_number_1' => 'required',
            'phone_number_2' => 'required',
            'email' => 'required',
            'gst_number' => 'required',
            'pin_code' => 'required',
            'consignee_branch_id' => 'required',
            'consignee_name' => 'required',
            'consignee_address' => 'required',
            'consignee_phone_number_1' => 'required',
            'consignee_phone_number_2' => 'required',
            'consignee_email' => 'required',
            'consignee_gst_number' => 'required',
            'consignee_pin_code' => 'required',
            'dest_pin_code' => 'required',
            'services_line' => 'required',
            'no_of_pkg' => 'required',
            'actual_weight' => 'required',
            'packing_type' => 'required',
            'freight_amount' => 'required',
            'os_amount' => 'required',
            'fov_amount' => 'required',
            'transhipment_amount' => 'required',
            'handling_charge_amount' => 'required',
            'loading_charge_amount' => 'required',
            'misc_charge_amount' => 'required',
            'other_charge_amount' => 'required',
            'grand_total_amount' => 'required',
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
            'packing_type' => $request->packing_type,
            'transhipmen_one' => $request->transhipmen_one,
            'transhipmen_two' => $request->transhipmen_two,
            'transhipment_three' => $request->transhipment_three,
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
            'created_at' => date('d-m-Y')
        ]);

        return redirect()->route('booking.create')->with('success', 'Paid booking saved successfully!');
    }

    public function to_pay_booking_save(Request $request)
    {

        $request->validate([
            'consignor_branch_id' => 'required',
            'consignor_name' => 'required',
            'address' => 'required',
            'phone_number_1' => 'required',
            'phone_number_2' => 'required',
            'email' => 'required',
            'gst_number' => 'required',
            'pin_code' => 'required',
            'consignee_branch_id' => 'required',
            'consignee_name' => 'required',
            'consignee_address' => 'required',
            'consignee_phone_number_1' => 'required',
            'consignee_phone_number_2' => 'required',
            'consignee_email' => 'required',
            'consignee_gst_number' => 'required',
            'consignee_pin_code' => 'required',
            'dest_pin_code' => 'required',
            'services_line' => 'required',
            'no_of_pkg' => 'required',
            'actual_weight' => 'required',
            'packing_type' => 'required',
            'freight_amount' => 'required',
            'os_amount' => 'required',
            'fov_amount' => 'required',
            'transhipment_amount' => 'required',
            'handling_charge_amount' => 'required',
            'loading_charge_amount' => 'required',
            'misc_charge_amount' => 'required',
            'other_charge_amount' => 'required',
            'grand_total_amount' => 'required',
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
            'packing_type' => $request->packing_type,
            'transhipmen_one' => $request->transhipmen_one,
            'transhipmen_two' => $request->transhipmen_two,
            'transhipment_three' => $request->transhipment_three,
            'freight_amount' => $request->freight_amount,
            'os_amount' => $request->os_amount,
            'fov_amount' => $request->fov_amount,
            'transhipment_amount' => $request->transhipment_amount,
            'handling_charge_amount' => $request->handling_charge_amount,
            'loading_charge_amount' => $request->loading_charge_amount,
            'misc_charge_amount' => $request->misc_charge_amount,
            'other_charge_amount' => $request->other_charge_amount,
            'grand_total_amount' => $request->grand_total_amount,
            'booking_type' => 2, // Paid booking type
            'status' => 1,
            'created_at' => date('d-m-Y')
        ]);

        return redirect()->route('booking.create')->with('success', 'Paid booking saved successfully!');
    }
    public function to_client_booking_save(Request $request)
    {

        $request->validate([
            'consignor_branch_id' => 'required',
            'consignor_name' => 'required',
            'address' => 'required',
            'phone_number_1' => 'required',
            'phone_number_2' => 'required',
            'email' => 'required',
            'gst_number' => 'required',
            'pin_code' => 'required',
            'consignee_branch_id' => 'required',
            'consignee_name' => 'required',
            'consignee_address' => 'required',
            'consignee_phone_number_1' => 'required',
            'consignee_phone_number_2' => 'required',
            'consignee_email' => 'required',
            'consignee_gst_number' => 'required',
            'consignee_pin_code' => 'required',
            'dest_pin_code' => 'required',
            'services_line' => 'required',
            'no_of_pkg' => 'required',
            'actual_weight' => 'required',
            'packing_type' => 'required',
            'freight_amount' => 'required',
            'os_amount' => 'required',
            'fov_amount' => 'required',
            'transhipment_amount' => 'required',
            'handling_charge_amount' => 'required',
            'loading_charge_amount' => 'required',
            'misc_charge_amount' => 'required',
            'other_charge_amount' => 'required',
            'grand_total_amount' => 'required',
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
            'packing_type' => $request->packing_type,
            'transhipmen_one' => $request->transhipmen_one,
            'transhipmen_two' => $request->transhipmen_two,
            'transhipment_three' => $request->transhipment_three,
            'freight_amount' => $request->freight_amount,
            'os_amount' => $request->os_amount,
            'fov_amount' => $request->fov_amount,
            'transhipment_amount' => $request->transhipment_amount,
            'handling_charge_amount' => $request->handling_charge_amount,
            'loading_charge_amount' => $request->loading_charge_amount,
            'misc_charge_amount' => $request->misc_charge_amount,
            'other_charge_amount' => $request->other_charge_amount,
            'grand_total_amount' => $request->grand_total_amount,
            'booking_type' => 3, // Paid booking type
            'status' => 1,
            'created_at' => date('d-m-Y')
        ]);

        return redirect()->route('booking.create')->with('success', 'Paid booking saved successfully!');
    }



    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $Booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $Booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $Booking)
    {
        //
    }
}
