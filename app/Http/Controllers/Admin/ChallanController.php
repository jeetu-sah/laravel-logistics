<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoadingChallan;
use App\Models\Booking;
use App\Models\LoadingChallanBooking;
use App\Library\sHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        // dd($request->all());
        if (!empty($request->bookingId)) {
            $bookings = $request->bookingId;
            $challanNumber = sHelper::fetchChallanNumber();

            $challanRespos = LoadingChallan::create([
                'challan_number' => $challanNumber,
                'busNumber' => $request->busNumber,
                'driverName' => $request->driverName,
                'driverMobile' => $request->driverMobile,
                'locknumber' => $request->locknumber,
                'created_by' => Auth::user()->id
            ]);

            if ($challanRespos) {
                foreach ($bookings as $booking) {
                    // Update or create the loading challan booking
                    LoadingChallanBooking::updateOrCreate(
                        ['loading_challans_id' => $challanRespos->id, 'booking_id' => $booking],
                        ['loading_challans_id' => $challanRespos->id, 'booking_id' => $booking]
                    );

                    // Update the status in the booking table (assuming 'status' is the column name)
                    \DB::table('bookings')->where('id', $booking)->update(['status' => 2]); // or the appropriate status value
                }

                return redirect('admin/challans/' . $challanRespos->id)->with([
                    "alertMessage" => true,
                    "alert" => ['message' => 'Challan has been generated !!!', 'type' => 'success']
                ]);
            }
        } else {
            // Redirect or return a response if no bookings are selected
            return redirect('admin/challans/create')->with([
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
        $totalRecord = LoadingChallan::count(); // Total record count

        // Initialize the query
        $loadingChallanQuery = LoadingChallan::query();

        // If there is a search query, add a where condition
        if ($search) {
            $loadingChallanQuery->where('challan_number', 'like', "%$search%") // Search by challan_number
                ->orWhere('busNumber', 'like', "%$search%"); // You can add other columns to search as well
        }

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
        // Fetch the challan bookings based on the challan ID
        $challanBookings = LoadingChallanBooking::where('loading_challans_id', $id)
            ->join('loading_challans', 'loading_challans.id', '=', 'loading_challan_booking.loading_challans_id')
            ->join('bookings', 'bookings.id', '=', 'loading_challan_booking.booking_id') // Join with bookings table
            // ->where('bookings.status', 2)
            // ->where('loading_challans.status', 'Accept')
            ->select('loading_challan_booking.*', 'loading_challans.status as chalanStatus', 'loading_challans.id as chalanId', 'loading_challans.challan_number', 'loading_challans.busNumber', 'loading_challans.driverName', 'loading_challans.driverMobile', 'loading_challans.locknumber', 'loading_challans.created_at') // Include the challan_number field
            ->get();

        // Initialize an array to store booking details
        $bookingDetails = [];

        foreach ($challanBookings as $challanBooking) {
            // Fetch booking details using the booking ID and eager load related branch data
            $bookingInfo = Booking::with(['consignorBranch', 'consigneeBranch'])
                ->find($challanBooking->booking_id);

            // Access the branch names and set default value if they don't exist
            $consignorBranchName = $bookingInfo->consignorBranch->branch_name ?? 'N/A';
            $consigneeBranchName = $bookingInfo->consigneeBranch->branch_name ?? 'N/A';

            if ($bookingInfo) {
                // Add the branch names to the booking info
                $bookingInfo->consignorBranchName = $consignorBranchName;
                $bookingInfo->consigneeBranchName = $consigneeBranchName;

                // Add the challan number to the booking info
                $bookingInfo->challan_number = $challanBooking->challan_number;
                $bookingInfo->busNumber = $challanBooking->busNumber;
                $bookingInfo->driverName = $challanBooking->driverName;
                $bookingInfo->driverMobile = $challanBooking->driverMobile;
                $bookingInfo->locknumber = $challanBooking->locknumber;
                $bookingInfo->chalanId = $challanBooking->chalanId;
                $bookingInfo->created_at = $challanBooking->created_at;
                $bookingInfo->chalanStatus = $challanBooking->chalanStatus;
                // Add the booking info with branch names and challan number to the array
                $bookingDetails[] = $bookingInfo;
            }
        }


        //    dd($bookingDetails);//
        return view('admin.challan.delevery-booking', [
            'challan_id' => $id,
            'bookings' => $bookingDetails, // Now this contains combined data of booking and branch names
        ]);
    }

    public function recived(Request $request)
    {

        $selectedBookings = $request->input('selectedBookings');
        $chalan_id = $request->input('chalan_id');

        $totalLoadingChallan = LoadingChallanBooking::count();

        $totalRecordBooking = Booking::count();

        if (!$selectedBookings) {
            return redirect()->back()->with('error', 'No bookings selected.');
        }

        // Update the status in the bookings table
        Booking::whereIn('id', $selectedBookings)->update(['status' => 3]);
        if ($totalLoadingChallan == $totalRecordBooking) {
            LoadingChallan::where('id', $chalan_id)->update(['status' => 'Accept']);
        }
        return view('admin.challan.list');
    }




}
