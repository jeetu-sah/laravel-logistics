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
use App\Models\DeliveryReceiptPayment;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Delivery | Gatepass';
        return view('admin.delivery.list', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function details($deliveryReceiptId)
    {
        $data['title'] = 'Delivery | Details| Payment';
        $data['pendingAmount'] = 0;
        $data['deliveryReceipt'] = DeliveryReceipt::with(['booking'])->where('id', $deliveryReceiptId)->first();
        if ($data['deliveryReceipt']) {
            $data['pendingAmount'] = $data['deliveryReceipt']->booking->bookingPendingAmount();
        }
        return view('admin.delivery.details', $data);
    }

    public function gatepassAmounts()
    {
        $data['title'] = 'Delivery | Gatepass | Amount';
        return view('admin.delivery.gatepassamounts', $data);
    }

    public function list(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        // $totalRecord = Booking::where('status', Booking::RECEIVED_FINAL_TRANSHIPMENT)->count();
        $bookingQuery = Booking::query();
        $bookingQuery->where('consignee_branch_id', Auth::user()->branch_user_id);
        $bookingQuery->where('status', Booking::RECEIVED_FINAL_TRANSHIPMENT);
        // $bookingQuery->orWhere('consignee_branch_id', Auth::user()->branch_user_id);
        if ($search) {
            $bookingQuery->where('bilti_number', 'like', "%$search%")
                ->orWhere('consignor_name', 'like', "%$search%")
                ->orWhere('consignee_name', 'like', "%$search%");
        }
        $totalRecord = $bookingQuery->count();
        $bookings = $bookingQuery->skip($start)->take($limit)->get();

        $rows = [];
        if ($bookings->count() > 0) {
            foreach ($bookings as $index => $booking) {
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
                $row['action'] = ' <a href="' . url("admin/delivery/gatepass/create/{$booking->id}") . '" class="btn btn-success">Generate Gatepass</a>';
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
     * gatepass amount loist.
     */
    public function gatepassList(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        // $totalRecord = Booking::where('status', Booking::RECEIVED_FINAL_TRANSHIPMENT)->count();
        $query = DeliveryReceipt::with(['booking']);
        $query->where('branch_id', Auth::user()->branch_user_id);
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('delivery_number', 'like', "%$search%")
                    ->orWhereHas('booking', function ($bookingQuery) use ($search) {
                        $bookingQuery->where('bilti_number', 'like', "%$search%");
                    });
            });
        }
        $totalRecord = $query->count();
        $deliveryReceipts = $query->skip($start)->take($limit)->get();

        $rows = [];
        if ($deliveryReceipts->count() > 0) {
            foreach ($deliveryReceipts as $index => $deliveryReceipt) {
                $row = [];
                $row['bilti_number'] = $deliveryReceipt?->booking?->bilti_number ?? '--';
                $row['delivery_number'] = $deliveryReceipt?->delivery_number ?? '--';

                $row['reciver_mobile'] = $deliveryReceipt?->reciver_mobile ?? '--';
                $row['recived_by'] = $deliveryReceipt?->recived_by ?? '--';

                $row['grand_total'] = "&#8377;" . $deliveryReceipt?->grand_total ?? '--';
                $row['received_amount'] = "&#8377;" . $deliveryReceipt?->received_amount ?? '--';
                $row['pending_amount'] = "&#8377;" . $deliveryReceipt?->pending_amount ?? '--';

                $row['created_at'] = formatDate($deliveryReceipt->created_at);
                $row['action'] = '<a href="#" class="btn btn-primary">Edit</a> &nbsp; <a href="' . url("admin/delivery/gatepass-amount/detail/{$deliveryReceipt->id}") . '" class="btn btn-success">Detail</a>';
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
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
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

        try {
            DB::beginTransaction();
            $imagePath = null;
            if ($request->hasFile('parcel_image')) {
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
                'discount' => $request->discount,
                'reciver_mobile' => $request->reciver_mobile,
                'status' => 'generated-gatepass',
                'branch_id' => Auth::user()->branch_user_id ?? NULL,
                'parcel_image' => $imagePath ?? '--',
            ]);
            if ($deliveryReceipt) {
                //update and create new record for payment. 
                DeliveryReceiptPayment::create([
                    'delivery_receipt_id' => $deliveryReceipt->id,
                    'pending_amount' => $request->pending_amount,
                    'received_amount' => $request->received_amount,
                    'notes' => 'Gatepass time payment',
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
                ])->withInput();
            }
        } catch (\Exception $e) {
            // echo $e->getMessage();
            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Something went wrong, please try again', 'type' => 'danger']
            ])->withInput();
        }
    }

    /**
     * addDeliveryPayment 
     */
    public function addDeliveryPayment(Request $request, $deliveryReceptId)
    {
        $request->validate([
            'received_amount' => 'required|numeric',
            'pending_amount' => 'required|numeric',
            'notes' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();
            $deliveryReceipt = DeliveryReceipt::find($deliveryReceptId);
            if (!$deliveryReceipt) {
                return redirect()->back()->with([
                    "alertMessage" => true,
                    "alert" => ['message' => 'Delivery receipt not found!', 'type' => 'danger']
                ]);
            }

            $deliveryReceiptPayment = DeliveryReceiptPayment::create([
                'delivery_receipt_id' => $deliveryReceptId,
                'pending_amount' => $request->pending_amount,
                'received_amount' => $request->received_amount,
                'notes' => $request->note ?? NULL,
            ]);
            DB::commit();
            return redirect("admin/delivery/gatepass-amount/detail/$deliveryReceptId")->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Delivery receipt created successfully!!!', 'type' => 'success']
            ]);
        } catch (\Exception $e) {
            // echo $e->getMessage();
            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Something went wrong, please try again', 'type' => 'danger']
            ])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
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
        $data['title'] = 'Delivery | Gatepass | Create';
        $data['booking'] = Booking::with(['consignorBranch', 'consigneeBranch'])->where('bookings.id', $id)->first();
        return view('admin.delivery.deliver', $data);
    }
}
