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

            $challanRespos = LoadingChallan::create(['challan_number' => $challanNumber, 'busNumber' => $request->busNumber, 'driverName' => $request->driverName, 'driverMobile' => $request->driverMobile, 'locknumber' => $request->locknumber, 'created_by' => Auth::user()->id]);
            if ($challanRespos) {
                foreach ($bookings as $booking) {
                    LoadingChallanBooking::updateOrCreate(
                        ['loading_challans_id' => $challanRespos->id, 'booking_id' => $booking],
                        ['loading_challans_id' => $challanRespos->id, 'booking_id' => $booking]
                    );
                }

                return redirect('admin/challans/create')->with([
                    "alertMessage" => true,
                    "alert" => ['message' => 'Challan has been generated !!!', 'type' => 'success']
                ]);
            }
        } else {
            // Redirect or return a response
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
                 $row['challan_number'] = '<a href="#" data-value="' . $loadingChallan->challan_number . '" class="challan-number">' . $loadingChallan->challan_number . '</a>';

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
     
    // public function show(Request $request, $id)
    // {
    //     // Fetch the challan ID based on the challan number
    //     $challanId = LoadingChallan::where('challan_number', $id)->pluck('id')->first();
    
    //     // Fetch all bookings associated with the given challan ID
    //     $bookings = LoadingChallanBooking::where('loading_challans_id', $challanId)->get();
    
    //     // Get the booking details for each booking_id from the booking table
    //     $bookingDetails = [];
    //     foreach ($bookings as $booking) {
    //         // Fetch booking details using booking_id
    //         $bookingInfo = Booking::where('id', $booking->booking_id)->first();
    //         $bookingDetails[] = $bookingInfo; // Add the booking info to the array
    //     }
    
       
    // }
    
}
