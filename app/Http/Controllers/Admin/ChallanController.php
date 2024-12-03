<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoadingChallan;
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
        if (!empty($request->bookingId)) {
            $bookings = $request->bookingId;
            $challanNumber = sHelper::fetchChallanNumber();

            $challanRespos = LoadingChallan::create(['challan_number' => $challanNumber, 'created_by' => Auth::user()->id]);
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
         $limit = request()->input('length');
         $start = request()->input('start');
         $totalRecord = LoadingChallan::count();
 
         $loadingChallanQuery = LoadingChallan::query();
                                
         $loadingChallans = $loadingChallanQuery->skip($start)->take($limit)->get();

         $row = [];
         if ($loadingChallans->count() > 0) {
             $i = 1;
             foreach ($loadingChallans as $loadingChallan) {

                 $change_credential = NULL;
                 $edit_btn = '<a href="' . url("admin/reviewers/edit/" . $loadingChallan->id) . '" data-toggle="tooltip" title="Edit Record" class="btn btn-primary" style="margin-right: 5px;">
                         <i class="fas fa-edit"></i> 
                       </a>';
 
                 //if(Auth::user()->isAbleTo('change-user-credential')){
                 $change_credential = '<a href="' . url("admin/edit_credential/" . $loadingChallan->id) . '" data-toggle="tooltip" title="Edit Record" class="btn btn-success" style="margin-right: 5px;">
                         <i class="fas fa-key"></i> 
                       </a>';
                 //}
                 $row = [];
                 $row['sn'] = '<a href="' . url("admin/roles/user_permission/$loadingChallan->id?page=roles") . '">' . $loadingChallan->id . '</a>';;
 
                 $row['challan_number'] = '<a href="' . route('bookings.bilti', ['id' => $loadingChallan->challan_number]) . '">' . $loadingChallan->challan_number . '</a>';

                 $row['email'] = $loadingChallan->email;
                 $row['created_at'] = Carbon::parse($loadingChallan->created_at)->format('d/m/Y  h:i:s');
                 
 
                 $row['action'] = $edit_btn . " " . $change_credential;
 
                 $rows[] = $row;
             }
         }
 
         $json_data = array(
             "draw"            => intval(request()->input('draw')),
             "recordsTotal"    => intval($totalRecord),
             "recordsFiltered" => intval($totalRecord),
             "data"            => $rows
         );
         // echo "<pre>";
         // print_r($json_data);exit;
         return json_encode($json_data);
         exit;
     }
}
