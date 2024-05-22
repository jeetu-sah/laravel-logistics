<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Admin;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actionUrl = 'admin/check-login';
        $method = 'post';
        $btnName = 'Login';
        $data = compact('actionUrl', 'method', 'btnName');
        return view('login.login')->with($data);
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
        // Step 1: Validate the request data
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            // Custom error messages
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.'
        ]);

        // Step 2: Attempt to find the admin in the database
        $result = Admin::where('email', $validatedData['email'])->first();

        if ($result && Hash::check($validatedData['password'], $result->password)) {
            // Admin found, set session data based on role
            $request->session()->put('id', $result->id);
            $request->session()->put('name', $result->name);
            $request->session()->put('role_id', $result->role_id);

            // Redirect based on role
            if ($result->role_id == 1) {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/users/dashboard');
            }
        } else {
            // Admin not found or password incorrect, redirect back with error message
            return redirect('/')->withErrors(['error' => 'Invalid email or password']);
        }
    }




    /**
     * Display the specified resource.
     */
    public function show(Login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Login $login)
    {
        //
    }
}
