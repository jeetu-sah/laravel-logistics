<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Client;
use App\Models\ClientMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($clientId)
    {
        $data['title'] = 'Map Client';
        $clientDetails = Client::with('branches')->find($clientId);
        $data['selectedConsignorBranches'] = $clientDetails->branches
            ->filter(function ($branch) {
                return $branch->pivot->type === ClientMap::TYPE_CONSIGNOR;
            })
            ->pluck('id')
            ->toArray();

        $data['selectedConsigneeBranches'] = $clientDetails->branches
            ->filter(function ($branch) {
                return $branch->pivot->type === ClientMap::TYPE_CONSIGNEE;
            })
            ->pluck('id')
            ->toArray();

        $data['clientDetails'] = $clientDetails;



        $data['branch'] = Branch::all();
        return view('admin.client.client-map', $data);
    }

    public function clientMap(Request $request)
    {
        $data['title'] = 'Client Map';
        $data['clients'] = Client::all();
        return view('admin.client.clientMap', $data);
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
        $mapType = $request->input('map_type');

        try {
            DB::beginTransaction();

            ClientMap::where('client_id', $clientId)
                ->where('type', $mapType)
                ->delete();

            foreach ($branchIds as $branchId) {
                ClientMap::updateOrCreate(
                    [
                        'client_id' => $clientId,
                        'branch_id' => $branchId,
                        'type' => $mapType,
                    ],
                    [
                        'status' => 'active',
                        'type' => $mapType,
                        'created_at' => now(),
                        'updated_at' => now(),

                    ]
                );
            }

            DB::commit();

            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => "Assign successfully.", 'type' => 'success']
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Something went wrong.', 'type' => 'danger']
            ]);
        }
    }


    // public function storeClientMapping(Request $request)
    // {

    //     $fromClientId = $request->input('from_client_id');

    //     $toClientIds = $request->input('to_client_ids', []);
    //     foreach ($toClientIds as $toClientId) {
    //         DB::table('client_to_client_map')->insert([
    //             'from_client_id' => $fromClientId,
    //             'to_client_id' => $toClientId,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Client mapping updated successfully.');
    // }
}
