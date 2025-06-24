<?php

namespace App\Http\Controllers\Admin;

use App\Models\DeliveryReceipt;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\sHelper;
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

        return view('admin.delivery.list');
    }

    public function list(Request $request)
    {

        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        $totalRecord = Booking::where('status', Booking::RECEIVED_FINAL_TRANSHIPMENT)->count();
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
                $row['bilti_number'] = $booking->bilti_number;

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

                $row['booking_type'] = '<span class="badge badge-danger">' . $booking->booking_type . '</span>';
                $row['grand_total_amount'] = "&#8377;" . $booking?->grand_total_amount;
                // Format the creation date
                $row['created_at'] = formatDate($booking->created_at);
                // Action column
                $row['action'] = ' <a href="' . url("admin/delivery/create/{$booking->id}") . '" class="btn btn-success">Generate Gatepass</a>';
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

        return response()->json($json_data);
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
            $request->validate([
                'freight_charges' => 'required|numeric',
                'hamali_charges' => 'required|numeric',
                'demruge_charges' => 'required|numeric',
                'others_charges' => 'required|numeric',
                'grand_total' => 'required|numeric',
                'received_amount' => 'required|numeric',
                'pending_amount' => 'required|numeric',
                'parcel_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            DB::beginTransaction();
            // Handle image upload if present
            $imagePath = null;
            if ($request->hasFile('parcel_image')) {
                // Store the image in the 'public' directory
                $imagePath = $request->file('parcel_image')->store('parcel_images', 'public');
            }

            $serialNumber = sHelper::getNextDeliveryNumber();

            // Insert the data into the delivery_receipts table
            $deliveryReceipt = DeliveryReceipt::create([
                'booking_id' => $request->booking_id,
                'freight_charges' => $request->freight_charges ?? 0,
                'hamali_charges' => $request->hamali_charges ?? 0,
                'demruge_charges' => $request->demruge_charges ?? 0,
                'others_charges' => $request->others_charges ?? 0,
                'grand_total' => $request->grand_total ?? 0,
                'received_amount' => $request->received_amount ?? 0,
                'pending_amount' => $request->pending_amount,
                'delivery_number' => $serialNumber,
                'recived_by' => $request->recived_by,
                'reciver_mobile' => $request->reciver_mobile,
                'status' => 'Delivered', // or any default value you need
                'parcel_image' => $imagePath ?? '--', // Store the image path
            ]);
            if ($deliveryReceipt) {
                // Insert the serial number and booking_id into the delivery_numbers table
                DB::table('delivery_numbers')->insert([
                    'delivery_number' => $serialNumber,
                    'booking_id' => $request->booking_id,
                    'status' => 1,  // Assuming 'status' 1 means active
                ]);

                $booking = Booking::find(id: $request->booking_id);
                if ($booking) {
                    $booking->status = Booking::DELIVERED_TO_CLIENT;
                    $booking->save();
                }

                DB::commit();
                return redirect()->route('admin.delivery.receipt', ['id' => $deliveryReceipt->id])->with([
                    "alertMessage" => true,
                    "alert" => ['message' => 'Delivery receipt created successfully!!!', 'type' => 'success']
                ]);

            } else {

                DB::rollBack();
                return redirect()->back()->with([
                    "alertMessage" => true,
                    "alert" => ['message' => 'Something went wrong, please try again', 'type' => 'danger']
                ]);
            }

        } catch (\Exception $e) {
            // echo $e->getMessage();
            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Something went wrong, please try again', 'type' => 'danger']
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Fetch the delivery receipt data by ID
        $deliveryReceipt = DeliveryReceipt::with(['booking'])->find($id);

        if (!$deliveryReceipt) {
            return redirect('admin/delivery')->with('error', 'Delivery receipt not found!');
        }
    
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

        return view('admin.delivery.deliver', $data);
    }
}
