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
        $limit  = $request->input('length', 10);
        $start  = $request->input('start', 0);

        // Base Query
        $clientQuery = Client::query();

        // Search Filter
        if ($search) {
            $clientQuery->where(function ($query) use ($search) {
                $query->where('client_name', 'like', "%{$search}%")
                    ->orWhere('client_address', 'like', "%{$search}%")
                    ->orWhere('client_phone_number', 'like', "%{$search}%")
                    ->orWhere('client_gst_number', 'like', "%{$search}%")
                    ->orWhere('client_email', 'like', "%{$search}%")
                    ->orWhere('client_aadhar_card', 'like', "%{$search}%");
            });
        }

        // Clone BEFORE pagination
        $filteredCount = (clone $clientQuery)->count();
        $totalCount    = Client::count();

        // Fetch with pagination
        $clients = $clientQuery->with('branch')
            ->orderBy('created_at', 'desc')
            ->skip($start)
            ->take($limit)
            ->get();

        $rows = [];
        foreach ($clients as $index => $client) {
            $rows[] = [
                'sn' => $start + $index + 1,
                'client_name' => $client->client_name,
                'client_address' => $client->client_address,
                'client_phone_number' => $client->client_phone_number,
                'client_gst_number' => $client->client_gst_number,
                'client_branch_id' => $client->branch?->branch_name ?? 'N/A',
                'client_email' => $client->client_email,
                'client_aadhar_card' => $client->client_aadhar_card,
                'created_at' => formatDate($client->created_at),
                'action' => '
                <div class="dropdown">
                    <button class="btn btn-light btn-sm" type="button" id="actionMenu' . $client->id . '" data-bs-toggle="dropdown">
                        <i class="fa fa-list"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="actionMenu' . $client->id . '">
                        <li>
                            <a class="dropdown-item" href="' . url("admin/clients/edit/{$client->id}") . '">
                                <i class="fas fa-pencil-alt me-2"></i> Edit
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-danger delete-client" 
                               href="' . url("admin/clients/delete/{$client->id}") . '" 
                               onclick="return confirm(\'Are you sure you want to delete this client?\')">
                                <i class="fas fa-trash me-2"></i> Delete
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-info" href="' . url("admin/clients/map-to-branch/{$client->id}") . '">
                                <i class="fas fa-random me-2"></i> Map to Branch
                            </a>
                        </li>
                    </ul>
                </div>'
            ];
        }

        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filteredCount,
            "data" => $rows,
        ]);
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
