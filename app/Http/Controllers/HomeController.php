<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Career;

class HomeController extends Controller
{

    public function index()
    {
        // Fetch the states based on the country_id
        $data['state'] = DB::table('country_states')->where('country_id', 101)->get();

        // Set the page title
        $data['title'] = 'logistics';

        // Fetch the careers and join with state_cities table
        $data['careers'] = Career::query()
            ->join('state_cities', 'careers.location', '=', 'state_cities.id') // Join careers with state_cities based on location
            ->select('careers.*', 'state_cities.name as location') // Select all columns from careers and name as location from state_cities
            ->get(); // Execute the query

        // Return the view with the data
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
