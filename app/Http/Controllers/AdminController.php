<?php

namespace App\Http\Controllers;

use App\Library\sHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'dashboard';
        $data['roles'] = Auth::user()->roles;
        $data['selectedRole'] = sHelper::activeLoggedInUserRole(Auth::user());
     
        return view('admin.dashboard.dashboard', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function adminlayout()
    {
        $data['title'] = 'login';
        return view('admin.dashboard.dashboard', $data);
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
        //
    }

}
