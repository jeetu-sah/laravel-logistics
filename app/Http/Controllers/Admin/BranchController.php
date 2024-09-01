<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['branchDetails'] = Branch::all();
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
     * Display the specified resource.
     */
    public function show(Branch $Branch)
    {
        $data['branchDetails'] = Branch::all();
        return view('admin.branch.list', $data);
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
        return redirect('admin/branch/list')->with('success', 'Branch created successfully!');
    }


    public function list(Request $request)
    {
        $limit = request()->input('length');
        $start = request()->input('start');
        $totalRecord = Branch::count();

        $branchQuery = Branch::query();
        $branches = $branchQuery->skip($start)->take($limit)->get();

        $rows = [];
        if ($branches->count() > 0) {
            $i = 1;
            foreach ($branches as $branch) {
                $row = [];
                $row['sn'] =  $branch->id;
                $row['branch_name'] = $branch->branch_name;
                $row['branch_code'] = '<a href="' . url("admin/roles/user_permission/$branch->id?page=roles") . '">' . $branch->branch_code . '</a>';
                $row['owner_name'] = $branch->owner_name;
                $row['contact'] = $branch->contact;
                $row['gst'] = $branch->gst;
                $row['user_status'] = $branch->user_status;
                $row['action'] = 'action';
                $row['created_at'] = Carbon::parse($branch->craeted_at)->format('d/m/Y'); //->format();

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
