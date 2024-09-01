<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['heading']  = 'Create Branch';
        $data['listUrl'] = 'admin/branch/branch-list';
        $data['states'] =  DB::table('country_states')->get();

        return view('admin.branch.create-branch', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(Branch $Branch)
    {
        $data['branchDetails'] = Branch::all();
        return view('admin.branch.branch-list', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $Branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $Branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $Branch)
    {
        //
    }

    public function getDistricts($stateId)
    {
        // Using the query builder to fetch districts based on the state ID
        $districts = DB::table('district')
            ->where('state_id', $stateId)
            ->get(['district_id', 'district_name']);

        // Return the districts as a JSON response
        return response()->json($districts);
    }

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
        Branch::create([
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
        return redirect('admin/branch/branch-list')->with('success', 'Branch created successfully!');
    }
}
