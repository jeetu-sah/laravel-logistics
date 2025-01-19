<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $data['state'] = DB::table('country_states')->where('country_id', 101)->get();


        $data['title'] = 'logisticks';
        return view('home.index')->with($data);
    }

    public function getDistricts(Request $request, $stateId)
    {

        // Using the query builder to fetch districts based on the state ID
        $districts = DB::table('state_cities')
            ->where('state_id', $stateId)
            ->get(['id', 'name']);

        // Return the districts as a JSON response
        return response()->json($districts);
    }
}
