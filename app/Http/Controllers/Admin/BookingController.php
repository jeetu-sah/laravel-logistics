<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // Validate the form data
        $request->validate([
            'consignor_branch_name' => 'nullable|exists:branch,id',
            'consignor_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone_number_1' => 'nullable|string|max:255',
            'phone_number_2' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'gst_number' => 'nullable|string|max:255',
            'pin_code' => 'nullable|string|max:10',
            'consignee_branch_name' => 'nullable|exists:branch,id',
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
            'actual_weight' => 'nullable|string', // Updated to string
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
            // No need to validate booking_type here
        ]);

        // Create a new booking record with booking_type set to 1 and status set to 1 by default
        Booking::create($request->merge([
            'booking_type' => 1,
            'status' => 1
        ])->except(['booking_type'])); // Exclude booking_type from mass assignment

        // Redirect or return response
        return redirect()->route('booking.create')->with('success', 'Booking saved successfully!');
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
