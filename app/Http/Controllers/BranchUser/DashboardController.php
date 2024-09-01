<?php

namespace App\Http\Controllers\BranchUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Library\sHelper;

class DashboardController extends Controller
{
    public function index()
    {
        $data['title'] = 'Branch | Dashboard';
        $data['roles'] = Auth::user()->roles;
        $data['selectedRole'] = sHelper::activeLoggedInUserRole(Auth::user());
        return view('branchuser.dashboard.dashboard')->with($data);
    }
}
