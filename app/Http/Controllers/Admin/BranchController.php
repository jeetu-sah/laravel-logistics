<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Branch list';
        return view('admin.branch.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data['countries'] = DB::table('countries')->whereIn('code', ['NP', 'IN'])->get();
        $data['states'] = DB::table('country_states')->get();

        return view('admin.branch.create', $data);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'branch_name' => 'required|string|max:255',
            'branch_code' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'gst' => 'required|string|max:255',
            'country_name' => 'required|string',
            'state_name' => 'required|integer',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'user_status' => 'required|string',
            'loginId' => 'required',
            'password' => 'required',
        ]);

        // Create a new Branch instance and save the data
        $branch = Branch::create([
            'branch_name' => $request->input('branch_name'),
            'branch_code' => $request->input('branch_code'),
            'owner_name' => $request->input('owner_name'),
            'contact' => $request->input('contact'),
            'gst' => $request->input('gst'),
            'country_name' => $request->input('country_name'),
            'state_name' => $request->input('state_name'),
            'city_name' => $request->input('district_name'),
            'address1' => $request->input('address1'),
            'address2' => $request->input('address2'),
            'user_status' => $request->input('user_status'),
        ]);

        if ($branch) {
            User::create(attributes: [
                'first_name' => $branch->branch_name,
                'last_name' => $branch->owner_name,
                'email' => $request->loginId, 
                'email_verified_at' => Carbon::now(),
                'mobile' => $branch->contact,
                'mobile_verified_at' => Carbon::now(),
                'password' => Hash::make($request->password),
                'user_type' => 'branch-user',
                'user_status' => 'active',
                'term_and_condition' => 1,
                'branch_user_id' => $branch->id,
            ]);
            // Redirect or return a response
            return redirect('admin/branches')->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Branch created successfully', 'type' => 'success']
            ]);

        } else {
            return redirect('admin/branches')->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Something went wrong, please try again', 'type' => 'danger']
            ]);
        }
    }

    public function list(Request $request)
    {
        $limit = $request->input('length', 10); // Default to 10 if 'length' is not provided
        $start = $request->input('start', 0);   // Default to 0 if 'start' is not provided

        // Get total record count
        $totalRecord = Branch::count(); // Simplified to directly get the count

        // Create a query builder instance and apply pagination
        $branches = Branch::skip($start)->take($limit)->get();

        $rows = [];
        if ($branches->count() > 0) {
            foreach ($branches as $index => $branch) {
                $row = [];
                $row['sn'] = $start + $index + 1; // Corrected SN to start from the current page's start index
                $row['branch_name'] = $branch->branch_name;
                $row['branch_code'] = '<a href="' . url("admin/branches/edit/{$branch->id}") . '">' . $branch->branch_code . '</a>';
                $row['owner_name'] = $branch->owner_name;
                $row['contact'] = $branch->contact;
                $row['gst'] = $branch->gst;
                $row['user_status'] = $branch->user_status;
                $row['action'] = '<a href="' . url("admin/branches/edit/{$branch->id}") . '" class="btn btn-primary">Edit</a> ';
                $row['action'] .= '<a href="' . url("admin/branches/deletebranch/{$branch->id}") . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to soft delete this branch?\')">Delete</a>';

                $row['created_at'] = Carbon::parse($branch->created_at)->format('d/m/Y');

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

    /**
     * Display the specified resource.
     */
    public function show(Branch $branches)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['title'] = 'Edit Branch';
        $data['branch'] = Branch::with('user')->find($id);
        
        $data['countries'] = DB::table('countries')->whereIn('code', ['NP', 'IN'])->get();
        return view('admin.branch.edit', $data);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branches)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'branch_name' => 'required|string|max:255',
            'branch_code' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'gst' => 'required|string|max:255',
            'country_name' => 'required|string',
            'state_name' => 'required|integer',
            'district_name' => 'required|integer',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'user_status' => 'required|string',
        ]);

        // Create a new Branch instance and save the data
        $branch = Branch::find($id);
        if ($branch != null) {
            $branch->branch_name = $request->branch_name;
            $branch->branch_code = $request->branch_code;
            $branch->owner_name = $request->owner_name;
            $branch->contact = $request->contact;
            $branch->gst = $request->gst;
            $branch->country_name = $request->country_name;
            $branch->state_name = $request->state_name;
            $branch->city_name = $request->district_name;
            $branch->address1 = $request->address1;
            $branch->address2 = $request->address2;
            $branch->user_status = $request->user_status;
        }

        if ($branch->save()) {
           // $user = User::
            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Branch updated successfully', 'type' => 'success']
            ]);
        } else {
            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => [
                    'message' => 'Something went wrong, please try after sometime',
                    'type' => 'success'
                ]
            ]);
        }
    }

    public function deletebranch($id)
    {

        $branch = Branch::findOrFail($id);

        // Soft delete the branch
        $branch->delete();

        return redirect('admin/branches')->with('success', 'Branch deleted successfully.');
    }

}
