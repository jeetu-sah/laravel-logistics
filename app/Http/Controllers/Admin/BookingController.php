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
        // echo "<pre>";
        // $branch = Branch::find(1);
        // print_r($branch->fromBookings);exit;

        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        $totalRecord = Booking::count();
        $bookings = Booking::skip($start)->take($limit)->get();

        $rows = [];
        if ($bookings->count() > 0) {
            foreach ($bookings as $index => $booking) {
                $row = [];
                $row['sn'] = $start + $index + 1; // Corrected SN to start from the current page's start index
                $row['bilti_number'] = '<a href="' . route('bookings.bilti', ['id' => $booking->id]) . '">' . $booking->bilti_number . '</a>';

                $row['consignor_branch_id'] = $booking?->consignorBranch?->branch_name;
                $row['consignor_name'] = $booking->consignor_name;
                $row['address'] = $booking->address;
                $row['phone_number_1'] = $booking->phone_number_1;
                $row['gst_number'] = $booking->gst_number;
                $row['consignee_branch_id'] = $booking?->consigneeBranch?->branch_name;
                $row['consignee_name'] = $booking->consignee_name;
                $row['consignee_address'] = $booking->consignee_address;
                $row['consignee_phone_number_1'] = $booking->consignee_phone_number_1;

                // Conditional logic for booking_type
                if ($booking->booking_type == 1) {
                    $row['booking_type'] = 'Paid ';
                } elseif ($booking->booking_type == 2) {
                    $row['booking_type'] = 'To Pay ';
                } elseif ($booking->booking_type == 3) {
                    $row['booking_type'] = 'Client ';
                } else {
                    $row['booking_type'] = 'Unknown'; // In case a different value is present
                }

                // Action column
                $row['action'] = '<a href="' . url("admin/bookings/edit/{$booking->id}") . '" class="btn btn-primary">Edit</a>';

                // Format the creation date
                $row['created_at'] = Carbon::parse($booking->created_at)->format('d/m/Y');

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
    public function bookings()
    {
        $data['branch'] = Branch::all();

        $data['heading'] = 'Add New Booking';
        $data['listUrl'] = 'admin/booking/booking-list';
        // $data['states'] =  DB::table('states')->get();

        return view('admin.booking.create-paid-booking', $data);
        ;
    }
    public function to_pay_booking()
    {
        $data['branch'] = Branch::all();
        return view('admin.booking.create-to-pay-booking', $data);
    }

    public function to_client_booking()
    {
        $data['branch'] = Branch::all();

        $data['heading'] = 'Add New Booking';
        $data['listUrl'] = 'admin/booking/booking-list';
        // $data['states'] =  DB::table('states')->get();

        return view('admin.booking.create-to-client-booking', $data);
    }

    public function paid_booking(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            // Consignor
            'consignor_branch_id' => 'required|exists:branches,id',
            'consignor_name' => 'required',
            'address' => 'required',
            'phone_number_1' => 'required',
            'phone_number_2' => 'nullable',
            'email' => 'required|email',
            'gst_number' => 'required',
            'pin_code' => 'required',
            // Consignee
            'consignee_branch_id' => 'required|exists:branches,id',
            'consignee_name' => 'required',
            'consignee_address' => 'required',
            'consignee_phone_number_1' => 'required',
            'consignee_phone_number_2' => 'nullable',
            'consignee_email' => 'required|email',
            'consignee_gst_number' => 'required',
            'consignee_pin_code' => 'required',
            // Other Details
            'no_of_artical' => 'required|integer',
            'actual_weight' => 'required|numeric',
            'packing_type' => 'required|string',
            'transhipmen_one' => 'nullable|exists:branches,id',
            'transhipmen_two' => 'nullable|exists:branches,id',
            'transhipment_three' => 'nullable|exists:branches,id',
            // Bills
            'good_of_value' => 'required|numeric',
            'fov_amount' => 'required|numeric',
            'freight_amount' => 'required|numeric',
            'os_amount' => 'nullable|numeric',
            'loading_charge_amount' => 'nullable|numeric',
            'misc_charge_amount' => 'nullable|numeric',
            'other_charge_amount' => 'nullable|numeric',
            'grand_total_amount' => 'required|numeric',
        ]);

        if ($request->consignor_branch_id == $request->consignee_branch_id) {
            return redirect()->back()->with(['error' => 'Consignor and consignee branches must be different.'])->withInput();
        }
        // genrate bilti_number
        $lastBilti = DB::table('bookings')->latest('id')->value('bilti_number');
        $nextBiltiNumber = $this->generateBiltiNumber($lastBilti);

        // Insert into the database
        DB::table('bookings')->insert([
            // consignor
            'bilti_number' => $nextBiltiNumber,
            'consignor_branch_id' => $request->consignor_branch_id,
            'consignor_name' => $request->consignor_name,
            'address' => $request->address,
            'phone_number_1' => $request->phone_number_1,
            'phone_number_2' => $request->phone_number_2,
            'email' => $request->email,
            'gst_number' => $request->gst_number,
            'pin_code' => $request->pin_code,
            // consignee
            'consignee_branch_id' => $request->consignee_branch_id,
            'consignee_name' => $request->consignee_name,
            'consignee_address' => $request->consignee_address,
            'consignee_phone_number_1' => $request->consignee_phone_number_1,
            'consignee_phone_number_2' => $request->consignee_phone_number_2,
            'consignee_email' => $request->consignee_email,
            'consignee_gst_number' => $request->consignee_gst_number,
            'consignee_pin_code' => $request->consignee_pin_code,
            // others details
            'no_of_artical' => $request->no_of_artical,
            'actual_weight' => $request->actual_weight,
            'packing_type' => $request->packing_type,
            'transhipmen_one' => $request->transhipmen_one,
            'transhipmen_two' => $request->transhipmen_two,
            'transhipment_three' => $request->transhipment_three,
            // bills
            'good_of_value' => $request->good_of_value,
            'fov_amount' => $request->fov_amount,
            'freight_amount' => $request->freight_amount,
            'os_amount' => $request->os_amount,
            'transhipmen_one_amount' => $request->transhipmen_one_amount,
            'transhipmen_two_amount' => $request->transhipmen_two_amount,
            'loading_charge_amount' => $request->loading_charge_amount,
            'transhipment_three_amount' => $request->transhipment_three_amount,
            'misc_charge_amount' => $request->misc_charge_amount,
            'other_charge_amount' => $request->other_charge_amount,
            'grand_total_amount' => $request->grand_total_amount,
            'created_at' => date('d-m-y'),
        ]);

        return redirect('admin/bookings')->with('success', 'Booking Created Successfully');
    }


    private function generateBiltiNumber($lastBiltiNumber)
    {
        // Extract the numeric part from the last bilti number, if it exists
        if ($lastBiltiNumber) {
            $lastNumber = (int) preg_replace('/[^0-9]/', '', $lastBiltiNumber);
            $nextNumber = $lastNumber + 1;
        } else {
            // If no last bilti number exists, start from 1
            $nextNumber = 1;
        }

        // Format it to your needs (for example, "BILTI-0001")
        return 'BILTI-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
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


    public function bilti($id)
    {
        $data['booking'] = Booking::findOrFail($id);
        return view('admin.booking.bilti', $data);
    }
}
