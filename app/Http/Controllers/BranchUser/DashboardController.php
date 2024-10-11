<?php

namespace App\Http\Controllers\BranchUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Library\sHelper;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $data['title'] = 'Branch | Dashboard';
        $data['roles'] = Auth::user()->roles;
        $data['selectedRole'] = sHelper::activeLoggedInUserRole(Auth::user());
        $data['totalBooking'] = Booking::count();
        return view('branchuser.dashboard.dashboard')->with($data);
    }
}
