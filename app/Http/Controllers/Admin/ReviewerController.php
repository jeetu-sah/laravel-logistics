<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Event\TestRunner\ExecutionAborted;

class ReviewerController extends Controller
{
    public function index()
    {
        $data['heading'] = 'Add Reviewers';
        $data['listUrl'] = 'admin/reviewers';
        return view('admin.reviewer.add-new-reviewers')->with($data);
    }

    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'mobile' => 'required|digits:10|unique:users',
                    'email' => 'required|string|email|max:255|unique:users',
                    'user_type' => 'required',
                    'password' => 'required|min:8',
                    'user_status' => 'required|string',
                ],
                [
                    // Custom error messages
                    'first_name.required' => 'First name is required.',
                    'last_name.required' => 'Last name is required.',
                    'mobile.required' => 'Mobile number is required.',
                    'mobile.digits' => 'Mobile number must be 10 digits.',
                    'mobile.unique' => 'This mobile number is already registered.',
                    'email.required' => 'Email is required.',
                    'email.email' => 'Please enter a valid email address.',
                    'email.unique' => 'This email is already registered.',
                    'user_type.required' => 'User type is required.',
                    'password.required' => 'Password is required.',
                    'password.min' => 'Password must be at least 8 characters.',
                    'user_status.required' => 'User status is required.',
                ]
            );

            $user = new User([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'user_type' => $request->user_type,
                'password' => Hash::make($request->password),
                'user_status' => $request->user_status,
                'term_and_condition' => 1,
            ]);

            $user->save();

            // Redirect to the reviewers list with a success message
            return redirect()->route('admin/reviewers-list')->with('success', 'New employee added successfully!');
        } catch (\Exception $e) {
            // Log the exception
            $e->getMessage();

            // Redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }



    public function show()
    {
        $data['allUsers'] = User::paginate(10);
        return view('admin.reviewer.reviewers-list')->with($data);
    }
}
