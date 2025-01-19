<?php

namespace App\Http\Controllers;

use App\Library\sHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'dashboard';
        $data['roles'] = Auth::user()->roles;
        $data['selectedRole'] = sHelper::activeLoggedInUserRole(Auth::user());
        return view('admin.dashboard.dashboard', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function adminlayout()
    {
        $data['title'] = 'login';
        return view('admin.dashboard.dashboard', $data);
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


    public function getStates(Request $request, $countryId)
    {
        $districts = DB::table('country_states')
            ->where('country_id', $countryId)
            ->get(['id', 'name']);

        // Return the state as a JSON response
        return response()->json($districts);
    }

    public function getDistricts(Request $request, $stateId)
    {
      
        // Using the query builder to fetch districts based on the state ID
        $districts = DB::table('state_cities')
            ->where('state_id', $stateId)
            ->get(['id', 'name']);
        // echo "<pre>";
        // print_r($districts);
        // exit;
        // Return the districts as a JSON response
        return response()->json($districts);
    }
}
