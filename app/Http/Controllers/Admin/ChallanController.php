<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoadingChallan;
use App\Models\Booking;
use App\Models\Transhipment;
use App\Models\LoadingChallanBooking;
use App\Library\sHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ChallanController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Challan';
        return view('admin.challan.list', $data);
    }


    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        $data['title'] = 'Challan Create';
        return view('admin.challan.create', $data);
    }

    /**
     * store the 
     * 
     */
    public function store(Request $request)
    {
        if (!empty($request->bookingId)) {
            $bookings = Booking::whereIn('id', $request->bookingId)->get();

            $challanNumber = sHelper::fetchChallanNumber();

            $result = DB::transaction(function () use ($challanNumber, $request, $bookings) {
                $challanRespos = LoadingChallan::create([
                    'challan_number' => $challanNumber,
                    'busNumber' => $request->busNumber,
                    'driverName' => $request->driverName,
                    'driverMobile' => $request->driverMobile,
                    'locknumber' => $request->locknumber ?: 'NA',
                    'coLoder' => $request->coLoder ?: 'NA',
                    'created_by' => Auth::user()->id
                ]);

                if ($challanRespos) {
                    foreach ($bookings as $booking) {
                        LoadingChallanBooking::create(
                            [
                                'loading_challans_id' => $challanRespos->id,
                                'booking_id' => $booking->id
                            ],
                        );
                        //update transhipment dispatched status for specific branch
                        $booking->branch_specific_transhipment->dispatched_at = now();
                        $booking->branch_specific_transhipment->status = Transhipment::DISPATCHED;
                        $booking->branch_specific_transhipment->update();

                        // Update the status in the booking table (assuming 'status' is the column name)
                        $booking->status = Booking::DISPATCH; // or the appropriate status value
                        $booking->save();
                    }
                }
                return ['challan' => $challanRespos];
            });


            return redirect('admin/challans/' . $result['challan']->id)->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Challan has been generated !!!', 'type' => 'success']
            ]);
        } else {
            // Redirect or return a response if no bookings are selected
            return redirect()->back()->withInput()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Please select the bookings', 'type' => 'warning']
            ]);
        }
    }


    /**
     * list the 
     * 
     */

    public function list(Request $request)
    {
        $limit = $request->input('length');
        $start = $request->input('start');
        $search = $request->input('search')['value']; // Get the search query
        $branchId = Auth::user()->branch_user_id;


        $loadingChallanQuery = LoadingChallan::with([
            'bookings.transhipments' => function ($query) use ($branchId) {
                $query->where('from_transhipment', $branchId);
            }
        ])
            ->whereHas('bookings.transhipments', function ($query) use ($branchId) {
                $query->where('from_transhipment', $branchId);
            });

        // echo "<pre>";
        // print_r($loadingChallans);
        // exit;
        //    $loadingChallanQuery = LoadingChallan::query()
        //         ->join('loading_challan_booking', 'loading_challans.id', '=', 'loading_challan_booking.loading_challans_id')
        //         ->join('bookings', 'bookings.id', '=', 'loading_challan_booking.booking_id')
        //         ->join('transhipments', 'transhipments.booking_id', '=', 'bookings.id')
        //         ->select('loading_challans.*')
        //         ->where('transhipments.from_transhipment', $branchId);

        $totalRecord = $loadingChallanQuery->count();

        //     // Get the filtered records based on search and pagination
        $loadingChallans = $loadingChallanQuery->skip($start)->take($limit)->get();

        $rows = [];
        if ($loadingChallans->count() > 0) {
            $i = 1;
            foreach ($loadingChallans as $loadingChallan) {

                $change_credential = NULL;
                $edit_btn = '<a href="' . url("admin/reviewers/edit/" . $loadingChallan->id) . '" data-toggle="tooltip" title="Edit Record" class="btn btn-primary" style="margin-right: 5px;">
                              <i class="fas fa-edit"></i> 
                            </a>';

                // Conditional check for permission (you can keep or remove this part based on your logic)
                $change_credential = '<a href="' . url("admin/edit_credential/" . $loadingChallan->id) . '" data-toggle="tooltip" title="Edit Record" class="btn btn-success" style="margin-right: 5px;">
                              <i class="fas fa-key"></i> 
                            </a>';

                $row = [];
                $row['sn'] = '<a href="' . url("admin/roles/user_permission/$loadingChallan->id?page=roles") . '">' . $loadingChallan->id . '</a>';
                $row['challan_number'] = '<a href="' . url('admin/challans', ['id' => $loadingChallan->id]) . '">' . $loadingChallan->challan_number . '</a>';
                $row['busNumber'] = strtoupper($loadingChallan->busNumber);
                $row['type'] = ($loadingChallan->user->branch_user_id == $branchId) ? '<span class="badge badge-danger">Self Created</span>' : '<span class="badge badge-danger">Created By ' . $loadingChallan?->user?->branch?->branch_name . '</span>';
                $row['created_at'] = formatDate($loadingChallan->created_at);
                $row['action'] = $edit_btn . " " . $change_credential;

                $rows[] = $row;
            }
        }

        // Return the response as JSON
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalRecord),
            "recordsFiltered" => intval($loadingChallanQuery->count()), // Filtered record count after applying search
            "data" => !empty($rows) ? $rows : []
        );

        return response()->json($json_data);
    }

    public function show(Request $request, $id)
    {
        $data['title'] = 'Challan List';
        $data['challan_id'] = $id;
        $data['branchId'] = Auth::user()->branch_user_id;

        //fetch all challan detail.
        $data['challanDetail'] = LoadingChallan::find($id);

        if ($data['challanDetail'] == NULL) {
            return redirect()->back()->with('danger', 'Something went wrong, please try after sometime.');
        }
        $bookings = $data['challanDetail']->bookings;
        // echo "<pre>";
        // print_r($bookings);exit;

        //enable checkbox for transhipment
        // Fetch the challan bookings based on the challan ID and join transhipments
        // $challanBookings = LoadingChallanBooking::where('loading_challans_id', $id)
        //     ->join('loading_challans', 'loading_challans.id', '=', 'loading_challan_booking.loading_challans_id')
        //     ->join('bookings', 'bookings.id', '=', 'loading_challan_booking.booking_id')
        //     ->leftJoin('transhipments', 'transhipments.booking_id', '=', 'bookings.id') // Left join for transhipments
        //     ->join('clients', 'clients.id', '=', 'bookings.client_id')
        //     ->select(
        //         'loading_challan_booking.*',
        //         'loading_challans.status as chalanStatus',
        //         'loading_challans.id as chalanId',
        //         'loading_challans.challan_number',
        //         'loading_challans.busNumber',
        //         'loading_challans.driverName',
        //         'loading_challans.driverMobile',
        //         'loading_challans.locknumber',
        //         'loading_challans.created_at',
        //         'loading_challans.coLoder',
        //         'clients.client_name as client_name',
        //         'clients.client_phone_number as client_mobile',
        //         'clients.client_address as client_address',
        //         'clients.client_gst_number as client_gst_number',
        //         'transhipments.id as transhipments_id',
        //         'transhipments.sequence_no',
        //         'transhipments.status as transhipment_status', // Add the transhipment status
        //         'bookings.consignee_branch_id',
        //         'bookings.status as bookingStatus',
        //         'bookings.id as bookingId',
        //     ) // Include the challan_number field
        //     ->get();

        // Process the fetched data
        // $bookingDetails = [];
        // foreach ($challanBookings as $challanBooking) {
        //     $bookingInfo = Booking::with(['consignorBranch', 'consigneeBranch'])
        //         ->find($challanBooking->booking_id);
        //     $consignorBranchName = $bookingInfo->consignorBranch->branch_name ?? 'N/A';
        //     $consigneeBranchName = $bookingInfo->consigneeBranch->branch_name ?? 'N/A';

        //     if ($bookingInfo) {
        //         $bookingInfo->consignorBranchName = $consignorBranchName;
        //         $bookingInfo->consigneeBranchName = $consigneeBranchName;
        //         $bookingInfo->challan_number = $challanBooking->challan_number;
        //         $bookingInfo->busNumber = $challanBooking->busNumber;
        //         $bookingInfo->driverName = $challanBooking->driverName;
        //         $bookingInfo->driverMobile = $challanBooking->driverMobile;
        //         $bookingInfo->locknumber = $challanBooking->locknumber;
        //         $bookingInfo->chalanId = $challanBooking->chalanId;
        //         $bookingInfo->created_at = $challanBooking->created_at;
        //         $bookingInfo->chalanStatus = $challanBooking->chalanStatus;
        //         $bookingInfo->coLoder = $challanBooking->coLoder;
        //         $bookingInfo->client_name = $challanBooking->client_name;
        //         $bookingInfo->client_mobile = $challanBooking->client_mobile;
        //         $bookingInfo->client_address = $challanBooking->client_address;
        //         $bookingInfo->client_gst_number = $challanBooking->client_gst_number;

        //         // Include transhipment data (whether it's the user's branch or a transhipment-related booking)
        //         $bookingInfo->transhipments_id = $challanBooking->transhipments_id;
        //         $bookingInfo->transhipment_status = $challanBooking->transhipment_status;
        //         $bookingInfo->to_transhipment = $challanBooking->to_transhipment;

        //         $bookingInfo->consignee_branch_id = $challanBooking->consignee_branch_id;
        //         $bookingInfo->bookingStatus = $challanBooking->bookingStatus;
        //         $bookingInfo->bookingId = $challanBooking->bookingId;

        //         // Check the transhipment status and determine if the checkbox should be shown
        //         $bookingInfo->show_checkbox = false;
        //         if ($challanBooking->transhipment_status == 'received' || $branchId == $challanBooking->from_transhipment) {
        //             $bookingInfo->show_checkbox = true; // Show checkbox if the transhipment has been received or it's the user's branch
        //         }

        //         $bookingDetails[] = $bookingInfo;
        //     }
        // }


        $data['bookings'] = $bookings;

        //$data['selectAllButtonDisable'] = collect($bookingDetails)->where('status', '!=', Booking::ACCEPT);

        return view('admin.challan.delevery-booking', $data);
    }


    public function recived(Request $request)
    {
        $selectedBookings = $request->input('selectedBookings');
        if (count($selectedBookings) > 0) {
            $bookings = Booking::whereIn('id', $selectedBookings)->get();
            // $chalan_id = $request->input('chalan_id');

            // $totalLoadingChallan = LoadingChallanBooking::count();
            // $totalRecordBooking = Booking::count();

            foreach ($bookings as $booking) {
                $booking->branch_specific_transhipment->received_at = now();
                $booking->branch_specific_transhipment->status = Transhipment::RECEIVED;
                $booking->branch_specific_transhipment->update();
            }

            // Check if all bookings are received for that challan
            // $challanBookingCount = LoadingChallanBooking::where('loading_challans_id', $chalan_id)->count();
            // $receivedBookingCount = LoadingChallanBooking::where('loading_challans_id', $chalan_id)
            //     ->whereHas('bookings', function ($q) {
            //         $q->where('status', 3);
            //     })->count();

            // if ($challanBookingCount == $receivedBookingCount) {
            //     LoadingChallan::where('id', $chalan_id)->update(['status' => 'completed']);
            // }
            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Booking Received successfully', 'type' => 'success']
            ]);
        } else {
            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Please select the bookings, which you want to received', 'type' => 'danger']
            ]);
        }
    }


    public function revertChallanbooking($challanId, $bookingId)
    {
        $challan = LoadingChallan::find($challanId);
        if ($challan) {
            $result = DB::transaction(function () use ($challan, $bookingId) {

                $challan->bookings()->detach($bookingId);
                //update the status of booking and transhipment. 
                $booking = Booking::find($bookingId);
                if ($booking) {
                    $booking->branch_specific_transhipment->dispatched_at = NULL;
                    $booking->branch_specific_transhipment->status = Transhipment::RECEIVED;
                    $booking->branch_specific_transhipment->update();

                    $booking->status = Booking::BOOKED;
                    $booking->save();
                }
            });

            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Booking has been revert !!!', 'type' => 'success']
            ]);
        } else {
            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Something went wrong, please try again', 'type' => 'danger']
            ]);
        }
    }
}
