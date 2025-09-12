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
}
