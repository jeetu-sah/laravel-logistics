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

use App\Services\CloudStorageService;
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
            $data['pendingAmount'] = $data['deliveryReceipt']->bookingPendingAmount();
        }
        return view('admin.delivery.details', $data);
    }


    public function receiverDetails($deliveryReceiptId)
    {
        $data['title'] = 'Delivery | Details| Payment';
        $data['pendingAmount'] = 0;
        $data['deliveryReceipt'] = DeliveryReceipt::with(['booking'])->where('id', $deliveryReceiptId)->first();
        if ($data['deliveryReceipt']) {
            $data['pendingAmount'] = $data['deliveryReceipt']->bookingPendingAmount();
        }
        return view('admin.delivery.receiver-detail', $data);
    }

    public function addReceiverDetails(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $deliveryReceipt = DeliveryReceipt::with('booking')->find($id);

            if (!$deliveryReceipt) {
                return redirect()->back()->with([
                    "alertMessage" => true,
                    "alert" => ['message' => 'Delivery receipt not found.', 'type' => 'danger']
                ]);
            }

            $booking = $deliveryReceipt->booking;

            // Update receiver details
            $booking->receiver_name = $request->receiver_name;
            $booking->receiver_mobile_number = $request->receiver_mobile;
            $booking->save();

            DB::commit();

            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Receiver details added successfully!!!', 'type' => 'success']
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => [
                    'message' => 'Something went wrong: ' . $e->getMessage(),
                    'type' => 'danger'
                ]
            ])->withInput();
        }
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

        $query = DeliveryReceipt::with(['booking'])
            ->where('branch_id', Auth::user()->branch_user_id);
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('delivery_number', 'like', "%$search%")
                    ->orWhere('recived_by', 'like', "%$search%")
                    ->orWhereHas('booking', function ($bookingQuery) use ($search) {
                        $bookingQuery->where('bilti_number', 'like', "%$search%");
                    });
            });
        }
        $orderColIndex = $request->input('order.0.column');
        $orderDir = $request->input('order.0.dir', 'asc');

        // Get column name from DataTable
        $columnName = $request->input("columns.$orderColIndex.data");

        // Columns actually available in database
        $dbSortable = [
            'delivery_number' => 'delivery_number',
            'reciver_mobile'  => 'reciver_mobile',
            'recived_by'      => 'recived_by',
            'grand_total'     => 'grand_total',
            'created_at'      => 'created_at',
        ];

        if (isset($dbSortable[$columnName])) {
            $query->orderBy($dbSortable[$columnName], $orderDir);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $totalRecord = $query->count();
        $deliveryReceipts = $query->skip($start)->take($limit)->get();
        /* --------------------------
        FORMAT RESPONSE DATA
    -------------------------- */
        $rows = [];

        foreach ($deliveryReceipts as $deliveryReceipt) {
            $rows[] = [
                'bilti_number'    => $deliveryReceipt->booking->bilti_number ?? '--',
                'delivery_number' => $deliveryReceipt->delivery_number,
                'reciver_mobile'  => $deliveryReceipt->reciver_mobile ?? '--',
                'recived_by'      => $deliveryReceipt->recived_by ?? '--',
                'grand_total'     => "&#8377;" . ($deliveryReceipt->grand_total ?? 0),
                'received_amount' => "&#8377;" . ($deliveryReceipt->bookingReceivedAmount() ?? 0),
                'pending_amount'  => "&#8377;" . ($deliveryReceipt->bookingPendingAmount() ?? 0),
                'created_at'      => formatDate($deliveryReceipt->created_at),
                'action'          => '
                <a href="' . url("admin/delivery/gatepass-amount/detail/{$deliveryReceipt->id}") . '" 
                   class="btn btn-success btn-sm">Payments Details</a>
                <a target="_blank" href="' . route('admin.delivery.receipt', ['id' => $deliveryReceipt->id]) . '" 
                   class="btn btn-warning btn-sm">Print</a>'
            ];
        }

        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalRecord,
            "recordsFiltered" => $totalRecord,
            "data" => $rows,
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request, CloudStorageService $storage)
    {
        $request->validate([
            'freight_charges' => 'required|numeric',
            'hamali_charges' => 'nullable|numeric',
            'demruge_charges' => 'nullable|numeric',
            'others_charges' => 'nullable|numeric',
            'grand_total' => 'nullable|numeric',
            'received_amount' => 'nullable|numeric',
            'pending_amount' => 'nullable|numeric',
        ]);

        try {
            DB::beginTransaction();
            $imagePath = null;
            if ($request->hasFile('parcel_image')) {
                $prefixFolderName = env('DEVELOPMENT_MODE') ? 'dev-photos' : 'prod-photos';
                $photoFolderName = $prefixFolderName . '/gatepass';
                $uploadedPathsOfPhotos = $storage->uploadWithDetails($photoFolderName, $request->file('parcel_image'));
                $imagePath = $uploadedPathsOfPhotos['full_url'];
            }

            if (!empty($request->delivery_number)) {
                $serialNumber = $request->delivery_number;
            } else {
                $serialNumber = sHelper::getNextDeliveryNumber();
            }

            // Insert the data into the delivery_receipts table
            $deliveryReceipt = DeliveryReceipt::create([
                'booking_id' => $request->booking_id,
                'freight_charges' => $request->freight_charges ?? 0,
                'hamali_charges' => $request->hamali_charges ?? 0,
                'demruge_charges' => $request->demruge_charges ?? 0,
                'others_charges' => $request->others_charges ?? 0,
                'grand_total' => $request->grand_total ?? 0,
                'received_amount' => $request->received_amount ?? 0,
                'pending_amount' => $request->pending_amount ?? 0,
                'delivery_number' => $serialNumber,
                'recived_by' => $request->recived_by,
                'discount' => $request->discount ?? 0,
                'remark' => $request->remark ?? NULL,
                'reciver_mobile' => $request->reciver_mobile,
                'status' => 'generated-gatepass',
                'branch_id' => Auth::user()->branch_user_id ?? NULL,
                'parcel_image' => $imagePath,
            ]);
            if ($deliveryReceipt) {
                DeliveryReceiptPayment::create([
                    'delivery_receipt_id' => $deliveryReceipt->id,
                    'pending_amount' => $request->pending_amount,
                    'received_amount' => $request->received_amount,
                    'notes' => $request->remark,
                ]);

                $booking = Booking::find(id: $request->booking_id);
                if ($booking) {
                    $booking->status = Booking::DELIVERED_TO_CLIENT;
                    $booking->save();
                }

                DB::commit();
                return redirect()->back()->with([
                    "alertMessage" => true,
                    "redirectAnotherRoute" => true,
                    "alert" => ['message' => 'Delivery receipt created successfully!!!', 'type' => 'success'],
                    "redirectGatepassId" => $deliveryReceipt->id,
                    "route" => route('admin.delivery.receipt', ['id' => $deliveryReceipt->id])
                ]);
            } else {
                DB::rollBack();
                return redirect()->back()->with([
                    "alertMessage" => true,
                    "alert" => ['message' => 'Something went wrong, please try again', 'type' => 'danger']
                ])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => $e->getMessage(), 'type' => 'danger']
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
            $deliveryReceipt = DeliveryReceipt::with('booking')->find($deliveryReceptId);
            if (!$deliveryReceipt) {
                return redirect()->back()->with([
                    "alertMessage" => true,
                    "alert" => ['message' => 'Delivery receipt not found!', 'type' => 'danger']
                ]);
            }
            if (!$deliveryReceipt->booking) {
                return redirect()->back()->with([
                    "alertMessage" => true,
                    "alert" => ['message' => 'Booking not found!', 'type' => 'danger']
                ]);
            }

            DeliveryReceiptPayment::create([
                'delivery_receipt_id' => $deliveryReceptId,
                'pending_amount' => $request->pending_amount,
                'received_amount' => $request->received_amount,
                'notes' => $request->notes ?? NULL,
            ]);

            $booking = $deliveryReceipt->booking;
            if (empty($booking->receiver_name)) {
                $booking->receiver_name = $request->receiver_name;
                $booking->receiver_mobile_number = $request->receiver_mobile;
                $booking->received_at = now();
                $booking->save();
            }

            DB::commit();
            return redirect("admin/delivery/gatepass-amount/detail/$deliveryReceptId")->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Delivery receipt created successfully!!!', 'type' => 'success']
            ]);
        } catch (\Exception $e) {
            // echo $e->getMessage();
            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => [
                    'message' => 'Something went wrong, please try again' . $e->getMessage(),
                    'type' => 'danger'
                ]
            ])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $deliveryReceipt = DeliveryReceipt::with(['booking'])->find($id);
        // echo "<pre>";
        // print_r($deliveryReceipt);exit;
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
