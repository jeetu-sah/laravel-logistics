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
    public function index($clientId)
    {
        $data['tittle'] = 'Map Client';
        $data['clientDetails'] = Client::with('branches')->find($clientId);
        $data['selectedBranches'] = $data['clientDetails']->branches->pluck('id')->toArray();

        $data['branch'] = Branch::all();
        return view('admin.client.client-map', $data);
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

    public function mapBranches(Request $request, $id)
    {
        $request->validate([
            'client_branch_id' => 'required|array',
            'client_branch_id.*' => 'exists:branches,id'
        ]);

        $clientId = $id;
        $branchIds = $request->input('client_branch_id');

        $inserted = 0;
        $skipped = 0;

        try {
            DB::beginTransaction();

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

            DB::commit();

            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => $inserted > 0 ? 'Assign successfully' : 'No new assignments made.', 'type' => 'success']
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Something went wrong.', 'type' => 'danger']
            ]);
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
