<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Distances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Client Details';
        $data['branch'] = Branch::all();
        return view('admin.client.create', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                // Consignor
                'client_name' => 'required|string', // Required
                'client_address' => 'required|string', // Optional
                'client_phone_number' => 'required|string', // Optional
                'client_gst_number' => 'nullable|string', // Optional
                'client_email' => 'nullable|email', // Optional
                'client_aadhar_card' => 'nullable', // Optional
            ]);


            $bookingId = DB::table('clients')->insertGetId([
                // Consignor

                'client_name' => $validatedData['client_name'],
                'client_address' => $validatedData['client_address'] ?? null,
                'client_phone_number' => $validatedData['client_phone_number'] ?? null,
                'client_gst_number' => $validatedData['client_gst_number'] ?? null,
                'client_email' => $validatedData['client_email'] ?? null,
                'client_aadhar_card' => $validatedData['client_aadhar_card'] ?? null,
                'status' => '1',

            ]);

            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => "Client Created Successfully.", 'type' => 'success']
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Something went wrong.', 'type' => 'danger']
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show()
    {
        $data['title'] = "Client List";
        return view('admin.client.list', $data);
    }


    public function list(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        $clientQuery = Client::query();

        // For debugging, let's print the query first to see if it's being built properly
        $sql = $clientQuery->toSql(); // Get the raw SQL query
        // Apply search filters if a search term is provided
        if ($search) {
            $clientQuery->where(column: function ($query) use ($search) {
                $query->where('client_name', 'like', "%$search%")
                    ->orWhere('client_branch_id', 'like', "%$search%");
            });
        }

        // Eager load the consignorBranch relationship
        $clients = $clientQuery->with('branch') // Eager loading branch data
            ->skip($start)
            ->take($limit)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalRecord = $clientQuery->count();
        $rows = [];

        if ($clients->count() > 0) {
            foreach ($clients as $index => $client) {
                $row = [];
                $row['sn'] = $start + $index + 1;
                // $row['client_id'] = '<a href="' . url('admin/clients/client-details', ['id' => $client->id]) . '">' . $client->id . '</a>';
                $row['client_name'] = $client->client_name;
                $row['client_address'] = $client->client_address;
                $row['client_phone_number'] = $client->client_phone_number;
                $row['client_gst_number'] = $client->client_gst_number;
                $row['client_branch_id'] = $client->branch->branch_name ?? 'N/A';

                $row['client_email'] = $client->client_email;
                $row['client_aadhar_card'] = $client->client_aadhar_card;
                $row['action'] = '<a href="' . url("admin/clients/edit/{$client->id}") . '" class="btn btn-primary">Edit</a>&nbsp;
                                  <a href="' . url("admin/clients/delete/{$client->id}") . '" class="btn btn-warning delete-client">Delete</a> &nbsp;
                                  <a href="' . url("admin/clients/map-to-branch/{$client->id}") . '" class="btn btn-info">Map to branch</a>';

                // Format the creation date
                $row['created_at'] = formatDate($client->created_at);

                // Append the row to the rows array
                $rows[] = $row;
            }
        }

        // Prepare the JSON response with correct record counts
        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalRecord,
            "recordsFiltered" => $totalRecord,
            "data" => $rows,
        ];

        // Return the JSON response
        return response()->json($json_data);
    }






    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = 'Edit Client Details';
        $data['client'] = Client::find($id);
        $data['branch'] = Branch::all();
        return view('admin.client.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                // Consignor
                'client_name' => 'required|string', // Required
                'client_address' => 'required|string', // Optional
                'client_phone_number' => 'required|string', // Optional
                'client_gst_number' => 'nullable|string', // Optional
                'client_email' => 'nullable|email', // Optional
                'client_aadhar_card' => 'nullable', // Optional
            ]);


            Client::where('id', $id)->update([
                'client_name' => $request->client_name,
                'client_address' => $request->client_address ?? null,
                'client_phone_number' => $request->client_phone_number ?? null,
                'client_gst_number' => $request->client_gst_number ?? null,
                'client_email' => $request->client_email ?? null,
                'client_aadhar_card' => $request->client_aadhar_card ?? null,
                'status' => '1',

            ]);

            // Redirect to the booking bilti page
            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => "Client Created Successfully.", 'type' => 'success']
            ]);
        } catch (\Exception $e) {

            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Something went wrong.', 'type' => 'danger']
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect('admin/clients')->with('success', 'Record deleted successfully');
    }


    public function getDistance(Request $request)
    {
        $consignorBranchId = $request->input('consignor_branch_id');

        $consigneeBranchId = $request->input('consignee_branch_id');

        // Assuming you have a Distance table with columns for 'consignor_branch_id', 'consignee_branch_id', and 'distance'
        $distance = DB::table('distances')
            ->where('from_branch_id', $consignorBranchId)
            ->where('to_branch_id', $consigneeBranchId)
            ->first();

        if ($distance) {
            return response()->json(['distance' => $distance->distance]);
        } else {
            return response()->json(['error' => 'Distance not found']);
        }
    }

    public function getClientDetail($id)
    {
        $client = Client::find($id);
        if ($client) {
            return response()->json([
                'status' => 'success',
                'data' => $client
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Client not found'
            ]);
        }
    }
}
