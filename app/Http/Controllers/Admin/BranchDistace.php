<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Distances;
use Illuminate\Support\Facades\Auth;
class BranchDistace extends Controller
{
    public function index()
    {
        $data['title'] = 'Distance';
        return view('admin.distances.list', $data);
    }

    public function create()
    {
        $data['title'] = 'Create Distance';
        $data['branch'] = Branch::all();
        return view('admin.distances.create', $data);
    }
    public function store(Request $request)
    {
        // Validation rules
        $validatedData = $request->validate([
            'from_branch_id' => 'required',
            'to_branch_id' => 'required',
            'distance' => 'required|integer',
            'status' => 'required|integer',
        ]);

        // Custom validation to ensure from_branch_id and to_branch_id are not the same
        if ($request->from_branch_id == $request->to_branch_id) {
            return redirect()->back()->with(['error' => 'From and To branch IDs cannot be the same.']);
        }

        // Create a new Distanc record using the validated data
        $distanc = Distances::create($validatedData);

        return redirect('admin/distances')->with('success', 'Distance created successfully');
    }

    public function list(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        $DistancesQuery = Distances::query()
            ->leftJoin('branches as from_branch', 'from_branch.id', '=', 'distances.from_branch_id')
            ->leftJoin('branches as to_branch', 'to_branch.id', '=', 'distances.to_branch_id');
        if ($search) {
            $DistancesQuery->where(function ($query) use ($search) {
                $query->where('consignor_name', 'like', "%$search%")
                    ->orWhere('consignee_name', 'like', "%$search%");
            });
        }
        $DistancesQuery->where('distances.status', 1);
        $totalRecord = $DistancesQuery->count();
        $distance = $DistancesQuery->skip($start)->take($limit)
            ->select('distances.*', 'from_branch.branch_name as from_branch_name', 'to_branch.branch_name as to_branch_name')
            ->orderBy('distances.created_at', 'desc')
            ->get();

        $rows = [];
        if ($distance->count() > 0) {
            foreach ($distance as $index => $distanc) {
                $row = [];
                $row['sn'] = $start + $index + 1;
                $row['from_branch_id'] = $distanc->from_branch_name;
                $row['to_branch_id'] = $distanc->to_branch_name ?? 'N/A';
                $row['distance'] = $distanc->distance .' '. 'KM';
                $row['status'] = '<a href="' . url("admin/distances/edit/{$distanc->id}") . '" class="btn btn-primary">Edit</a>&nbsp;
                              <a href="' . url("admin/distances/delete/{$distanc->id}") . '" class="btn btn-warning">Delete</a>';
                $rows[] = $row;
            }
        }

        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalRecord,
            "recordsFiltered" => $totalRecord,
            "data" => $rows,
        ];

        return response()->json($json_data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Distance';
        $distance = Distances::findOrFail($id);
        $branches = Branch::all();
        $data['distance'] = $distance;
        $data['branches'] = $branches;
        return view('admin.distances.edit', $data);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');

        // Validate incoming request data
        $validatedData = $request->validate([
            'from_branch_id' => 'required',
            'to_branch_id' => 'required',
            'distance' => 'required|integer',
            'status' => 'required|integer',
        ]);

        // Custom validation to ensure from_branch_id and to_branch_id are not the same
        if ($request->from_branch_id == $request->to_branch_id) {
            return redirect()->back()->with(['error' => 'From and To branch IDs cannot be the same.']);
        }

        // Find the existing Distance record by ID
        $distanc = Distances::find($id);

        // Check if the record exists
        if (!$distanc) {
            return redirect()->back()->with(['error' => 'Distance not found.']);
        }

        // Update the existing record with the validated data
        $distanc->update($validatedData);

        // Redirect back to the list of distances with a success message
        return redirect('admin/distances')->with('success', 'Distance updated successfully !');
    }


    public function delete($id)
    {
        // Soft delete a Distances
        $Distances = Distances::find($id);
        $Distances->delete();
        return redirect('admin/distances')->with('success', 'Record Deleted!');

    }
}
