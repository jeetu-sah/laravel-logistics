<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Library\sHelper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class LoginController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Login Action';
        $data['roles'] = Role::all();

        return view('login.adminLogin')->with($data);
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Step 1: Validate the request data
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            // Custom error messages
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.',
        ]);

        // Step 2: Attempt to find the admin in the database
        $user = User::where('email', $request->email)->first();

        if ($user != NULL) {
            if ($user->user_status == 'active') {
                if (Hash::check($request->password, $user->password)) {
                    $remember = $request->remeber_me;
                    // $role = $user->user_type;

                    // sHelper::activateLoggedInUserRole($user, $role);
                    Auth::login($user, $remember);
                    if ($user->user_type == 'admin') {
                        return redirect('/admin/dashboard')->with(["msg" => "<div class='callout callout-success'><strong>Success </strong>  Login Successfully !!! </div>"]);
                    } else if ($user->user_type == 'branch-user') {
                        return redirect('/branch-user/dashboard')->with(["msg" => "<div class='callout callout-success'><strong>Success </strong>  Login Successfully !!! </div>"]);
                    }
                } else {
                    return redirect()->back()->with(["msg" => "<div class='callout callout-danger'><strong>Wrong </strong>  password does not matched !!! </div>"]);
                }
            } else {
                return redirect()->back()->with(["msg" => "<div class='callout callout-danger'><strong>Wrong </strong>  Your account is blocked !!! </div>"]);
            }
        } else {
            // Admin not found or password incorrect, redirect back with error message
            return redirect('/')->withErrors(['error' => 'Invalid email or password']);
        }
    }

    public function forgetPassword(Request $request)
    {
        if ($request->method() === "GET") {
            return view('login.forget-password');
        }

        if ($request->method() === "POST") {
            $user = User::where('email', $request->username)->first();
            if ($user) {
                $token = Str::uuid()->toString();
                $email = $request->username;

                $deleteToken = DB::table('password_reset_tokens')->where('email', $email)->update(['deleted_at' => now()]);

                DB::table('password_reset_tokens')->insert([
                    'email' => $request->username,
                    'token' => $token,
                    'created_at' => now()
                ]);

                return view('login.reset-password', ['token' => $token, 'email' => $email]);
            } else {
                return redirect('/admin/dashboard')->with(["msg" => "<div class='callout callout-danger'><strong>Wrong </strong>  User does not exists!!! </div>"]);
            }
        }
    }

    public function resetPassword(Request $request)
    {

        if ($request->method() === "POST") {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user = User::where('email', $request->email)->first();
            if ($user) {
                $passwordToken = DB::table('password_reset_tokens')->where([['email', '=', $request->email], ['deleted_at', '=', NULL]])->first();

                if ($passwordToken) {

                    if ($passwordToken->token === $request->token) {
                        $user->password = Hash::make($request->password);
                        if ($user->save()) {
                            return redirect('/login')->with(["msg" => "<div class='callout callout-success'><strong>Success </strong>  Password updated successfully!!! </div>"]);
                        }
                    } else {
                        return redirect('/forget-password')->with(["msg" => "<div class='callout callout-danger'><strong>Wrong </strong>  Something went wrong, please try again!!! </div>"]);
                    }
                } else {
                    return redirect('/forget-password')->with(["msg" => "<div class='callout callout-danger'><strong>Wrong </strong>  Token does not exists, please try again!!! </div>"]);
                }
            } else {
                return redirect('/login')->with(["msg" => "<div class='callout callout-danger'><strong>Wrong </strong>  User does not exists!!! </div>"]);
            }
        }
    }
}
