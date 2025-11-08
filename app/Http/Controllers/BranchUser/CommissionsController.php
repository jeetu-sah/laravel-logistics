<?php

namespace App\Http\Controllers\BranchUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Library\sHelper;
use App\Models\Booking;
use App\Models\Branch;
use App\Models\Transhipment;

class CommissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Branch | Commisions';
        $data['roles'] = Auth::user()->roles;
        $data['currentBranch']  = Branch::currentbranch();
        $data['totalOutgoingCommisions'] = Transhipment::where([['from_transhipment', '=', $data['currentBranch']->id], ['type', '=', Transhipment::TYPE_SENDER]])->get()->sum('commision');
        $data['totalIncmingCommisions'] = Transhipment::where([['from_transhipment', '=', $data['currentBranch']->id], ['type', '=', Transhipment::TYPE_RECEIVER]])->get()->sum('commision');
        $data['totalTranshipmentCommisions'] = Transhipment::where([['from_transhipment', '=', $data['currentBranch']->id], ['type', '=', Transhipment::TYPE_TRANSHIPMENT]])->get()->sum('commision');
        return view('branchuser.commisions.index')->with($data);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function filterCommisions(Request $request)
    {
        $branch  = Branch::currentbranch();
        $filter = $request->input('filter');

        if ($filter == 'weekly') {
            $totalOutgoingCommisions = Transhipment::where([
                ['from_transhipment', '=', $branch->id],
                ['type', '=', Transhipment::TYPE_SENDER]
            ])->whereBetween('dispatched_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->get()->sum('commision');

            $totalIncmingCommisions = Transhipment::where([
                ['from_transhipment', '=', $branch->id],
                ['type', '=', Transhipment::TYPE_RECEIVER]
            ])->whereBetween('received_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->get()->sum('commision');

            $totalTranshipmentCommisions = Transhipment::where([
                ['from_transhipment', '=', $branch->id],
                ['type', '=', Transhipment::TYPE_TRANSHIPMENT]
            ])->whereBetween('dispatched_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->get()->sum('commision');

            return response()->json([
                'status' => 'success',
                'data' => [
                    'totalOutgoingCommisions' => $totalOutgoingCommisions,
                    'totalIncmingCommisions' => $totalIncmingCommisions,
                    'totalTranshipmentCommisions' => $totalTranshipmentCommisions
                ]
            ]);
        }
        if ($filter === 'custom') {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $totalOutgoingCommisions = Transhipment::where([
                ['from_transhipment', '=', $branch->id],
                ['type', '=', Transhipment::TYPE_SENDER]
            ])->whereBetween('dispatched_at', [$start_date, $end_date])
                ->get()->sum('commision');

            $totalIncmingCommisions = Transhipment::where([
                ['from_transhipment', '=', $branch->id],
                ['type', '=', Transhipment::TYPE_RECEIVER]
            ])->whereBetween('received_at', [$start_date, $end_date])
                ->get()->sum('commision');

            $totalTranshipmentCommisions = Transhipment::where([
                ['from_transhipment', '=', $branch->id],
                ['type', '=', Transhipment::TYPE_TRANSHIPMENT]
            ])->whereBetween('dispatched_at', [$start_date, $end_date])
                ->get()->sum('commision');

            return response()->json([
                'status' => 'success',
                'data' => [
                    'totalOutgoingCommisions' => $totalOutgoingCommisions,
                    'totalIncmingCommisions' => $totalIncmingCommisions,
                    'totalTranshipmentCommisions' => $totalTranshipmentCommisions
                ]
            ]);
        } elseif ($filter === 'monthly') {
            $month = $request->input('month_picker');
            $totalOutgoingCommisions = Transhipment::where([
                ['from_transhipment', '=', $branch->id],
                ['type', '=', Transhipment::TYPE_SENDER]
            ])
                ->whereMonth('dispatched_at', date('m', strtotime($month)))
                ->whereYear('dispatched_at', date('Y', strtotime($month)))
                ->get()->sum('commision');

            $totalIncmingCommisions =   Transhipment::where([
                ['from_transhipment', '=', $branch->id],
                ['type', '=', Transhipment::TYPE_RECEIVER]
            ])
                ->whereMonth('received_at', date('m', strtotime($month)))
                ->whereYear('received_at', date('Y', strtotime($month)))
                ->get()->sum('commision');

            $totalTranshipmentCommisions = Transhipment::where([
                ['from_transhipment', '=', $branch->id],
                ['type', '=', Transhipment::TYPE_TRANSHIPMENT]
            ])
                ->whereMonth('dispatched_at', date('m', strtotime($month)))
                ->whereYear('dispatched_at', date('Y', strtotime($month)))
                ->get()->sum('commision');;

            return response()->json([
                'status' => 'success',
                'data' => [
                    'totalOutgoingCommisions' => $totalOutgoingCommisions,
                    'totalIncmingCommisions' => $totalIncmingCommisions,
                    'totalTranshipmentCommisions' => $totalTranshipmentCommisions,

                ]
            ]);
        } elseif ($filter === 'yearly') {
            $year = $request->input('year_picker');
            $totalOutgoingCommisions = Transhipment::where([
                ['from_transhipment', '=', $branch->id],
                ['type', '=', Transhipment::TYPE_SENDER]
            ])->whereYear('dispatched_at', $year)->get()->sum('commision');

            $totalIncmingCommisions = Transhipment::where([
                ['from_transhipment', '=', $branch->id],
                ['type', '=', Transhipment::TYPE_RECEIVER]
            ])->whereYear('received_at', $year)->get()->sum('commision');

            $totalTranshipmentCommisions = Transhipment::where([
                ['from_transhipment', '=', $branch->id],
                ['type', '=', Transhipment::TYPE_TRANSHIPMENT]
            ])->whereYear('dispatched_at', $year)->get()->sum('commision');

            return response()->json([
                'status' => 'success',
                'data' => [
                    'totalOutgoingCommisions' => $totalOutgoingCommisions,
                    'totalIncmingCommisions' => $totalIncmingCommisions,
                    'totalTranshipmentCommisions' => $totalTranshipmentCommisions,
                ]
            ]);
        }
    }
}
