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
        $data['branch'] = Branch::all();

        $data['tittle'] = 'New Client';
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
                'consignor_branch_id' => 'required|exists:branches,id',
                'consignee_branch_id' => 'required|exists:branches,id',
                'aadhar_card' => 'nullable', // Optional

                // Consignee
                'consignor_name' => 'nullable|string', // Required
                'consignee_name' => 'nullable|string', // Required
                'consignor_address' => 'nullable|string', // Optional
                'consignee_address' => 'nullable|string', // Optional
                'consignor_phone_number' => 'nullable|string', // Optional
                'consignee_phone_number' => 'nullable|string', // Optional
                'consignor_gst_number' => 'nullable|string', // Optional
                'consignee_gst_number' => 'nullable|string', // Optional
                'consignor_email' => 'nullable|email', // Optional
                'consignee_email' => 'nullable|email', // Optional

                // Invoice details
                'distance' => 'nullable|numeric', // Optional
                'freight_amount' => 'nullable|numeric', // Optional
                'wbc_charges' => 'nullable|numeric', // Optional
                'handling_charges' => 'nullable|numeric', // Optional
                'fov_amount' => 'nullable|numeric', // Optional
                'fuel_amount' => 'nullable|numeric', // Optional
                'pickup_charges' => 'nullable|numeric', // Optional
                'hamali_Charges' => 'nullable|numeric', // Optional
                'bilti_Charges' => 'nullable|numeric', // Optional
                'discount' => 'nullable|numeric', // Optional
                'compney_charges' => 'nullable|numeric', // Optional
                'sub_total' => 'nullable|numeric', // Optional
                'cgst' => 'nullable|numeric', // Optional
                'sgst' => 'nullable|numeric', // Optional
                'igst' => 'nullable|numeric', // Optional
                'grand_total' => 'nullable|numeric', // Optional
                'misc_charge_amount' => 'nullable|numeric', // Optional
                'grand_total_amount' => 'required|numeric', // Required
            ]);

            // Check for matching consignor and consignee branch IDs
            if ($validatedData['consignor_branch_id'] == $validatedData['consignee_branch_id']) {
                return redirect()->back()->withErrors(['error' => 'Consignor and consignee branches must be different.'])->withInput();
            }

            // Insert data into the clients table
            $bookingId = DB::table('clients')->insertGetId([
                // Consignor
                'consignor_branch_id' => $validatedData['consignor_branch_id'],
                'consignor_name' => $validatedData['consignor_name'],
                'consignor_address' => $validatedData['consignor_address'] ?? null,
                'consignor_phone_number' => $validatedData['consignor_phone_number'] ?? null,
                'consignor_email' => $validatedData['consignor_email'] ?? null,
                'consignor_gst_number' => $validatedData['consignor_gst_number'] ?? null,
                // Consignee
                'consignee_branch_id' => $validatedData['consignee_branch_id'],
                'consignee_name' => $validatedData['consignee_name'],
                'consignee_address' => $validatedData['consignee_address'] ?? null,
                'consignee_phone_number' => $validatedData['consignee_phone_number'] ?? null,
                'consignee_email' => $validatedData['consignee_email'] ?? null,
                'consignee_gst_number' => $validatedData['consignee_gst_number'] ?? null,
                // Other Details
                'aadhar_card' => $validatedData['aadhar_card'] ?? null,
                'distance' => $validatedData['distance'] ?? 00,
                'freight_amount' => $validatedData['freight_amount'] ?? 00,
                'wbc_charges' => $validatedData['wbc_charges'] ?? 00,
                'handling_charges' => $validatedData['handling_charges'] ?? 00,
                'fov_amount' => $validatedData['fov_amount'] ?? 00,
                'fuel_amount' => $validatedData['fuel_amount'] ?? 00,
                'pickup_charges' => $validatedData['pickup_charges'] ?? 00,
                'hamali_Charges' => $validatedData['hamali_Charges'] ?? 00,
                'bilti_Charges' => $validatedData['bilti_Charges'] ?? 00,
                'discount' => $validatedData['discount'] ?? 00,
                'compney_charges' => $validatedData['compney_charges'] ?? 00,
                'sub_total' => $validatedData['sub_total'] ?? 00,
                'cgst' => $validatedData['cgst'] ?? 00,
                'sgst' => $validatedData['sgst'] ?? 00,
                'igst' => $validatedData['igst'] ?? 00,
                'grand_total' => $validatedData['grand_total'] ?? 00,
                'misc_charge_amount' => $validatedData['misc_charge_amount'] ?? 00,
                'grand_total_amount' => $validatedData['grand_total_amount'],
                'status' => '1',
                'created_at' => now(),
            ]);

            // Redirect to the booking bilti page
            return redirect('admin/clients')->with('success', 'Client Created Successfully');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show()
    {
        $data['tittle'] = "Client List";
        return view('admin.client.list', $data);
    }


    public function list(Request $request)
    {
        // Get input values from the request
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        // Start with the query builder
        $clientQuery = Client::query();
       
        // For debugging, let's print the query first to see if it's being built properly
        $sql = $clientQuery->toSql(); // Get the raw SQL query
        // Apply search filters if a search term is provided
        if ($search) {
            $clientQuery->where(function ($query) use ($search) {
                $query->where('consignor_name', 'like', "%$search%")
                    ->orWhere('consignee_name', 'like', "%$search%");
            });
        }

        // Filter active clients (status = 1)
        $clientQuery->where('status', 1);

        // Get the total record count before pagination
        $totalRecord = $clientQuery->count();

        // Get the paginated results
        $clients = $clientQuery->skip($start)->take($limit)->orderBy('created_at', 'desc')->get();
       
        // Prepare data for the response
        $rows = [];
        if ($clients->count() > 0) {
            foreach ($clients as $index => $client) {
                $row = [];
                $row['sn'] = $start + $index + 1;
                $row['client_id'] = '<a href="' . url('admin/bookings/to-client-booking', ['id' => $client->id]) . '">' . $client->id . '</a>';


                $row['consignor_branch_id'] = $client->consignorBranch?->branch_name ?? 'N/A';
                $row['consignor_name'] = $client->consignor_name;
                $row['consignor_address'] = $client->consignor_address;
                $row['phone_number_1'] = $client->consignor_phone_number;
                $row['gst_number'] = $client->gst_number;
                $row['consignee_branch_id'] = $client->consigneeBranch?->branch_name ?? 'N/A';
                $row['consignee_name'] = $client->consignee_name;
                $row['consignee_address'] = $client->consignee_address;
                $row['consignee_phone_number_1'] = $client->consignee_phone_number;
                $row['action'] = '<a href="' . url("admin/clients/edit/{$client->id}") . '" class="btn btn-primary">Edit</a>&nbsp;
                              <a href="' . url("admin/clients/delete/{$client->id}") . '" class="btn btn-warning">Delete</a>';

                // Format the creation date
                $row['created_at'] = date('d-m-Y', strtotime($client->created_at));

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
        $data['tittle'] = 'Edit Client Details';
        $data['client'] = DB::table('clients')
            ->join('branches as consignor_branch', 'clients.consignor_branch_id', '=', 'consignor_branch.id')
            ->join('branches as consignee_branch', 'clients.consignee_branch_id', '=', 'consignee_branch.id')
            ->where('clients.id', $id)
            ->select(
                'clients.*',  // Select all columns from clients table
                'consignor_branch.id as consignor_branch_id',
                'consignor_branch.branch_name as consignor_branch_name',
                'consignee_branch.id as consignee_branch_id',
                'consignee_branch.branch_name as consignee_branch_name'
            )
            ->first();
        $data['branch'] = Branch::all();

        return view('admin.client.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                // Consignor
                'consignor_branch_id' => 'required|exists:branches,id',
                'consignee_branch_id' => 'required|exists:branches,id',
                'aadhar_card' => 'nullable', // Optional

                // Consignee
                'consignor_name' => 'nullable|string', // Required
                'consignee_name' => 'nullable|string', // Required
                'consignor_address' => 'nullable|string', // Optional
                'consignee_address' => 'nullable|string', // Optional
                'consignor_phone_number' => 'nullable|string', // Optional
                'consignee_phone_number' => 'nullable|string', // Optional
                'consignor_gst_number' => 'nullable|string', // Optional
                'consignee_gst_number' => 'nullable|string', // Optional
                'consignor_email' => 'nullable|email', // Optional
                'consignee_email' => 'nullable|email', // Optional

                // Invoice details
                'distance' => 'nullable|numeric', // Optional
                'freight_amount' => 'nullable|numeric', // Optional
                'wbc_charges' => 'nullable|numeric', // Optional
                'handling_charges' => 'nullable|numeric', // Optional
                'fov_amount' => 'nullable|numeric', // Optional
                'fuel_amount' => 'nullable|numeric', // Optional
                'pickup_charges' => 'nullable|numeric', // Optional
                'hamali_Charges' => 'nullable|numeric', // Optional
                'bilti_Charges' => 'nullable|numeric', // Optional
                'discount' => 'nullable|numeric', // Optional
                'compney_charges' => 'nullable|numeric', // Optional
                'sub_total' => 'nullable|numeric', // Optional
                'cgst' => 'nullable|numeric', // Optional
                'sgst' => 'nullable|numeric', // Optional
                'igst' => 'nullable|numeric', // Optional
                'grand_total' => 'nullable|numeric', // Optional
                'misc_charge_amount' => 'nullable|numeric', // Optional
                'grand_total_amount' => 'required|numeric', // Required
            ]);
            $id = $request->input('client_id');

            // Check for matching consignor and consignee branch IDs
            if ($validatedData['consignor_branch_id'] == $validatedData['consignee_branch_id']) {
                return redirect()->back()->withErrors(['error' => 'Consignor and consignee branches must be different.'])->withInput();
            }

            // Find the client by ID and update the record
            $client = DB::table('clients')->where('id', $id)->first();

            if ($client) {
                DB::table('clients')->where('id', $id)->update([
                    // Consignor
                    'consignor_branch_id' => $validatedData['consignor_branch_id'],
                    'consignor_name' => $validatedData['consignor_name'],
                    'consignor_address' => $validatedData['consignor_address'] ?? null,
                    'consignor_phone_number' => $validatedData['consignor_phone_number'] ?? null,
                    'consignor_email' => $validatedData['consignor_email'] ?? null,
                    'consignor_gst_number' => $validatedData['consignor_gst_number'] ?? null,
                    // Consignee
                    'consignee_branch_id' => $validatedData['consignee_branch_id'],
                    'consignee_name' => $validatedData['consignee_name'],
                    'consignee_address' => $validatedData['consignee_address'] ?? null,
                    'consignee_phone_number' => $validatedData['consignee_phone_number'] ?? null,
                    'consignee_email' => $validatedData['consignee_email'] ?? null,
                    'consignee_gst_number' => $validatedData['consignee_gst_number'] ?? null,
                    // Other Details
                    'aadhar_card' => $validatedData['aadhar_card'] ?? null,
                    'distance' => $validatedData['distance'] ?? 00,
                    'freight_amount' => $validatedData['freight_amount'] ?? 00,
                    'wbc_charges' => $validatedData['wbc_charges'] ?? 00,
                    'handling_charges' => $validatedData['handling_charges'] ?? 00,
                    'fov_amount' => $validatedData['fov_amount'] ?? 00,
                    'fuel_amount' => $validatedData['fuel_amount'] ?? 00,
                    'pickup_charges' => $validatedData['pickup_charges'] ?? 00,
                    'hamali_Charges' => $validatedData['hamali_Charges'] ?? 00,
                    'bilti_Charges' => $validatedData['bilti_Charges'] ?? 00,
                    'discount' => $validatedData['discount'] ?? 00,
                    'compney_charges' => $validatedData['compney_charges'] ?? 00,
                    'sub_total' => $validatedData['sub_total'] ?? 00,
                    'cgst' => $validatedData['cgst'] ?? 00,
                    'sgst' => $validatedData['sgst'] ?? 00,
                    'igst' => $validatedData['igst'] ?? 00,
                    'grand_total' => $validatedData['grand_total'] ?? 00,
                    'misc_charge_amount' => $validatedData['misc_charge_amount'] ?? 00,
                    'grand_total_amount' => $validatedData['grand_total_amount'],
                    'status' => '1',  // Assuming you're updating the status to 1
                    'updated_at' => now(),
                ]);

                return redirect('admin/clients')->with('success', 'Client updated successfully.');
            } else {
                return redirect()->back()->withErrors(['error' => 'Client not found.']);
            }

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        // Soft delete a client
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

}
