<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FranchiseApplication;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class FranchiseApplicationController extends Controller
{
    public function index()
    {
        $data['title'] = 'Franchise Form';
        return view('home.franchise')->with($data);
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:18|max:100',
            'email' => 'required|email|unique:franchise_applications,email',
            'cell_number' => 'required|string|max:20',
            'landline_number' => 'required|string|max:20',
            'total_cash_invest' => 'required|numeric|min:0',
            'own_cash_invest' => 'required|numeric|min:0',
            'borrowed_funds' => 'required|numeric|min:0',
            'borrow_from' => 'required|string|max:255',
            'no_of_outlets' => 'required|integer|min:1',
            'areas_of_interest' => 'required|string',
            'planned_opening_date' => 'required|date|after_or_equal:today',
            'business_experience' => 'required|string',
            'additional_comments' => 'nullable|string',
            'signature_data' => 'required'
        ]);
        $signature_data = $request->input('signature_data');
        $fileName = 'signature_' . Str::random(10) . '.png';
        $folderPath = public_path('signatures/');
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
        }
        $image_parts = explode(";base64,", $signature_data);
        $image_base64 = base64_decode($image_parts[1]);
        $filePath = $folderPath . $fileName;
        file_put_contents($filePath, $image_base64);
        $validated['signature_data'] = 'signatures/' . $fileName;
        FranchiseApplication::create($validated);

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }

}
