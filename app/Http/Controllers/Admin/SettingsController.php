<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\sHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function changeSettings(Request $request)
    {
        $request->validate(
            [
                'role' => 'required',
            ],
            [
                // Custom error messages
                'role.required' => 'Please select a valid role !!!',
            ]
        );
        $user = Auth::user();
        $activeRole = sHelper::activeLoggedInUserRole($user);

        if ($activeRole->role_id != request()->role) {
            sHelper::activateLoggedInUserRole($user, request()->role);
        }

        return redirect()->back()->with(["msg"=>"<div class='notice notice-success notice'><strong>Success </strong>  Setting change successfully !!! </div>" ]);  
    }
}
