<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Login Action';

        return view('login.login')->with($data);
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
         $user = User::where('email', $request->email)->first();
         
         if ($user != NULL) {
           
            if($user->user_status == 'active'){
				if(Hash::check($request->password, $user->password)){
					$remember = $request->remeber_me;
					Auth::login($user , $remember); 
					return redirect('/admin')->with(["msg"=>"<div class='notice notice-success notice'><strong>Success </strong>  Login Successfully !!! </div>" ]);  
				   }
				else{
					 return redirect()->back()->with(["msg"=>"<div class='notice notice-danger notice'><strong>Wrong </strong>  password does not matched !!! </div>"]);  
				}		
			}
			else{
			  return redirect()->back()->with(["msg"=>"<div class='notice notice-danger notice'><strong>Wrong </strong>  Your account is blocked !!! </div>"]);
			}
         } else {
             // Admin not found or password incorrect, redirect back with error message
             return redirect('/')->withErrors(['error' => 'Invalid email or password']);
         }
     }
}
