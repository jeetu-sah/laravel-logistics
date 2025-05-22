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

        //self challan show, created by self
        $loadingChallanQuery = LoadingChallan::query()
            ->join('loading_challan_booking', 'loading_challans.id', '=', 'loading_challan_booking.loading_challans_id')
            ->join('bookings', 'bookings.id', '=', 'loading_challan_booking.booking_id')
            ->join('transhipments', 'transhipments.booking_id', '=', 'bookings.id')
            ->select('loading_challans.*')
            ->where('transhipments.from_transhipment', $branchId);
        if ($search) {
            $loadingChallanQuery->where('challan_number', 'like', "%$search%") // Search by challan_number
                ->orWhere('busNumber', 'like', "%$search%"); // You can add other columns to search as well
        }

        $totalRecord = $loadingChallanQuery->count(); // Total record count

        // Get the filtered records based on search and pagination
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
                $row['created_at'] = Carbon::parse($loadingChallan->created_at)->format('d/m/Y  h:i:s');
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
        $data['challanDetail'] = LoadingChallan::find($id);
        if ($data['challanDetail'] == NULL) {
            return redirect()->back()->with('danger', 'Something went wrong, please try after sometime.');
        }
        $bookings = $data['challanDetail']->bookings;

        $data['bookings'] = $bookings;
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
}
