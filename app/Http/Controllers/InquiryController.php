<?php

namespace App\Http\Controllers;
use App\Mail\InquiryMail;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Inquiry;
class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
                'name' => 'nullable|string|max:255',
                'email' => 'required|email|max:255',
                'mobile' => 'required|string|max:15',
                'states' => 'required|integer',
                'district' => 'required|integer',
                'destionation_state' => 'required|integer',
                'destination_district_name' => 'required|integer',
                'description' => 'required|string',
            ]);

            // Create a new inquiry record in the database
            $inquiry = Inquiry::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'state_id' => $request->states,
                'district_id' => $request->district,
                'destination_state_id' => $request->destionation_state,
                'destination_district_id' => $request->destination_district_name,
                'description' => $request->description,
            ]);

           
            Mail::to($request->email)->send(new InquiryMail($inquiry->toArray()));

            return redirect('/')->with('success', 'Inquiry submitted and email sent successfully.');

        } catch (Exception $e) {
            echo $e->getMessage();
            exit;

        }
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
