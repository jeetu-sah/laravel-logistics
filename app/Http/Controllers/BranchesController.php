<?php

namespace App\Http\Controllers;

use App\Models\Branches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['branchDetails'] = Branches::all();
        return view('admin.branch.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['heading']  = 'Create Branch';
        $data['listUrl'] = 'admin/branch/branch-list';
        $data['countries'] =  DB::table('countries')->whereIn('code', ['NP', 'IN'])->get();
        $data['states'] =  DB::table('country_states')->get();

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
            'district_name' => 'required|integer',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'user_status' => 'required|string',
        ]);

        // Create a new Branch instance and save the data
        Branches::create([
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

        // Redirect or return a response
        return redirect('admin/branches/list')->with([
            "alertMessage" => true,
            "alert" => ['message' => 'Branch created successfully', 'type' => 'success']
        ]);
    }

    public function list(Request $request)
    {
        $limit = $request->input('length', 10); // Default to 10 if 'length' is not provided
        $start = $request->input('start', 0);   // Default to 0 if 'start' is not provided

        // Get total record count
        $totalRecord = Branches::count(); // Simplified to directly get the count

        // Create a query builder instance and apply pagination
        $branches = Branches::skip($start)->take($limit)->get();

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
                $row['action'] = '<a href="' . url("admin/branches/edit/{$branch->id}") . '" class="btn btn-primary">Edit</a>';
                $row['created_at'] = Carbon::parse($branch->created_at)->format('d/m/Y');

                $rows[] = $row;
            }
        }

        // Prepare the JSON response with correct record counts
        $json_data = [
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => $totalRecord,
            "recordsFiltered" => $totalRecord, // Adjust this if you implement search/filter functionality
            "data"            => $rows,
        ];

        return response()->json($json_data); // Return a JSON response
    }

    /**
     * Display the specified resource.
     */
    public function show(Branches $branches)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['message'] = [];
        $data['branch'] = Branches::find($id);
        $data['countries'] =  DB::table('countries')->whereIn('code', ['NP', 'IN'])->get();
        return view('admin.branch.edit', $data);
    }

   
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branches $branches)
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
        $branch = Branches::find($id);
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
}
