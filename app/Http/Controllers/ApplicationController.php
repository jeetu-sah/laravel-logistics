<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;  // Create the Application model
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationReceivedMail;
class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'job_id' => 'required|exists:careers,id', // Assuming 'careers' is your jobs table
            'full_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'why_hire' => 'required|string|max:100',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Store the application data
        $application = new Application();
        $application->job_id = $validated['job_id'];
        $application->full_name = $validated['full_name'];
        $application->mobile = $validated['mobile'];
        $application->email = $validated['email'];
        $application->address = $validated['address'];
        $application->gender = $validated['gender'];
        $application->why_hire = $validated['why_hire'];

        // Store the resume file
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes');
            $application->resume = $resumePath;
        }

        $application->save();

        // Send email to admin
        Mail::to('vikaslogistics14320@gmail.com')->send(new ApplicationReceivedMail($application));

        // Return a response or redirect
        return back()->with('success', 'Your application has been submitted successfully.');
    }
}
