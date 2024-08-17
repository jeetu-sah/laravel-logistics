<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['heading']  = 'Create Branch';
        $data['listUrl'] = 'admin/branch/branch-list';
        $data['states'] =  DB::table('states')->get();

        return view('admin.branch.create-branch', $data);
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
    public function show(Branch $Branch)
    {
        return view('admin.branch.branch-list');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $Branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $Branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $Branch)
    {
        //
    }
}
