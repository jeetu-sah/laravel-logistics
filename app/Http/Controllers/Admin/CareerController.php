<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class CareerController extends Controller
{
    public function index()
    {
        // $data['tittle'] = 'Careers List';
        return view('admin.careers.index');
    }
    public function list(Request $request)
    {
        $search = $request->input('search.value') ?? null; // Use 'value' directly
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        $careerQuery = Career::query()
            ->join('state_cities', 'careers.location', '=', 'state_cities.id') // Join careers with states based on state_id
            ->select('careers.*', 'state_cities.name as location');

        // Check if the logged-in user is an admin or branch user
        if (!Auth::user()->is_admin) {

        }

        // Apply the search filter
        if ($search) {
            $careerQuery->where('name', 'like', "%$search%");
        }

        // Get total count of records before pagination
        $totalRecord = $careerQuery->count();

        // Fetch careers with pagination (skip and take)
        $careers = $careerQuery->skip($start)->take($limit)->orderBy('created_at', 'desc')->get();

        // Prepare the rows for the response
        $rows = [];
        if ($careers->isNotEmpty()) {
            foreach ($careers as $index => $career) {
                $row = [];
                $row['sn'] = $start + $index + 1;
                $row['name'] = $career->name;
                $row['salary'] = $career->salary;
                $row['location'] = $career->location; // Use null coalescing to avoid errors if null
                $row['post'] = $career->post;
                $row['description'] = $career->description;

                // Set the status
                $row['status'] = ucfirst($career->status); // Capitalize 'open' or 'closed'

                // Format the creation date
                $row['created_at'] = $career->created_at->format('d-m-Y'); // Using Carbon

                $row['action'] = '
    <a href="' . url('admin/careers/edit/' . $career->id) . '" class="btn btn-primary">Edit</a>
    <form action="' . url('admin/careers/delete/' . $career->id) . '" method="POST" style="display:inline;">
        ' . csrf_field() . '
        ' . method_field('DELETE') . '
        <button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this career?\')">Delete</button>
    </form>
';

                $rows[] = $row;
            }
        }

        // Return the JSON response with the required data
        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalRecord,
            "recordsFiltered" => $totalRecord, // Adjust if additional filtering is needed
            "data" => $rows,
        ];

        return response()->json($json_data);
    }
    public function applications()
    {
        $data['tittle'] = 'Applications List';
        return view('admin.careers.applications', $data);
    }


    public function applicationList(Request $request)
    {
        $search = $request->input('search.value') ?? null; // Use 'value' directly
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        $applicationQuery = Application::query()
            ->join('careers', 'careers.id', '=', 'applications.job_id') // Join careers with states based on state_id
            ->select('applications.*', 'careers.name as jobName');

        // Check if the logged-in user is an admin or branch user
        if (!Auth::user()->is_admin) {
            // Optional: Add additional filters for non-admin users if needed
        }

        // Apply the search filter
        if ($search) {
            $applicationQuery->where('applications.full_name', 'like', "%$search%"); // Adjust the column name as needed
        }

        // Get total count of records before pagination
        $totalRecord = $applicationQuery->count();

        // Fetch applications with pagination (skip and take)
        $applications = $applicationQuery->skip($start)->take($limit)->orderBy('applications.created_at', 'desc')->get();

        // Prepare the rows for the response
        $rows = [];
        if ($applications->isNotEmpty()) {
            foreach ($applications as $index => $application) {
                $row = [];
                $row['sn'] = $start + $index + 1;
                $row['full_name'] = ucfirst($application->full_name);
                $row['mobile'] = $application->mobile;
                $row['email'] = $application->email; // Adjust location if needed
                $row['gender'] = $application->gender;
                $row['address'] = $application->address;

                // Set the status field (or any other field that should indicate the application status)
                $row['why_hire'] = ucfirst($application->why_hire); // Example: Why should we hire you?

                // Handle resume field correctly (if it's required for status, update accordingly)
                if ($application->resume) {
                    $row['resume'] = '<a href="' . asset('storage/app/' . $application->resume) . '" target="_blank">Download</a>';
                } else {
                    $row['resume'] = 'No Resume';
                }

                // Format the creation date
                $row['created_at'] = $application->created_at->format('d-m-Y'); // Using Carbon for date formatting

                // Add the delete action (ensure the action key is initialized)
                $row['action'] = '<a  class="btn btn-danger" onclick="return confirm(\'Are you sure you want to soft delete this application?\')">Delete</a>';

                $rows[] = $row;
            }
        }

        // Return the JSON response with the required data
        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalRecord,
            "recordsFiltered" => $totalRecord, // Adjust if additional filtering is needed
            "data" => $rows,
        ];

        return response()->json($json_data);
    }



    public function create()
    {
        $data['tittle'] = 'Create New Careers';
        $data['locations'] = DB::table('country_states')->get();
        return view('admin.careers.create', $data);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required',
            'post' => 'required',
            'state_id' => 'required',
            'location' => 'required',
            'salary' => 'required',
            'description' => 'required',
            'staff_type' => 'required', // Validate that staff_type is an array (multi-select)
            'status' => 'required',
        ]);

        // Create a new Career entry in the database
        $career = Career::create([
            'name' => $validatedData['name'],
            'post' => $validatedData['post'],
            'state_id' => $validatedData['state_id'],
            'location' => $validatedData['location'],
            'salary' => $validatedData['salary'],
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'staff_type' => $validatedData['staff_type'],
        ]);



        // Redirect with success message
        return redirect()->back()->with('success', 'Job created successfully.');
    }

    public function edit($id)
    {
        $career = Career::findOrFail($id);
        $locations = DB::table('country_states')->get();
        $tittle = 'Edit';
        return view('admin.careers.edit', compact('career', 'tittle', 'locations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'post' => 'required',
            'state_id' => 'required',
            'location' => 'required',
            'salary' => 'required',
            'description' => 'required',
            'staff_type' => 'required', // Validate that staff_type is an array (multi-select)
            'status' => 'required',
        ]);

        $career = Career::findOrFail($id);
        $career->update($request->all());

        return redirect()->url('admin.careers.index')->with('success', 'Career updated successfully!');
    }
    public function destroy($id)
    {
        $career = Career::findOrFail($id);
        $career->delete(); // Soft delete if using `SoftDeletes` in Model

        return redirect()->back()->with('success', 'Career deleted successfully.');
    }

}
