<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MapClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['client'] = Client::all();
        $data['branch'] = Branch::all();
        $data['tittle'] = 'Map Client';
        return view('admin.client.map', $data);
    }
    public function clientMap(Request $request)
    {
        $tittle = 'Client Map';
        $clients = Client::all();
        return view('admin.client.clientMap', compact('clients', 'tittle'));
    }




    /**
     * Show the form for creating a new resource.
     */

    public function mapBranches(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'client_branch_id' => 'required|array',
            'client_branch_id.*' => 'exists:branches,id'
        ]);

        $clientId = $request->input('client_id');
        $branchIds = $request->input('client_branch_id');

        $inserted = 0;
        $skipped = 0;

        foreach ($branchIds as $branchId) {
            // Check if the mapping already exists
            $exists = DB::table('client_branch_map')
                ->where('client_id', $clientId)
                ->where('branch_id', $branchId)
                ->exists();

            if (!$exists) {
                DB::table('client_branch_map')->insert([
                    'client_id' => $clientId,
                    'branch_id' => $branchId,
                ]);
                $inserted++;
            } else {
                $skipped++;
            }
        }

        if ($inserted > 0) {
            return redirect()->back()->with('success', "$inserted branch(es) mapped successfully!");
        } else {
            return redirect()->back()->with('info', 'All selected branches are already mapped.');
        }
    }


    public function storeClientMapping(Request $request)
    {
       
        $fromClientId = $request->input('from_client_id');
       
        $toClientIds = $request->input('to_client_ids', []);
        foreach ($toClientIds as $toClientId) {
            DB::table('client_to_client_map')->insert([
                'from_client_id' => $fromClientId,
                'to_client_id' => $toClientId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Client mapping updated successfully.');
    }


}
