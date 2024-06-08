<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogOutController extends Controller
{
    /**
     * user logout functionality
     */
    public function index()
    {
        $data['title'] = 'logout';
        Auth::logout();
        return redirect('/');
    }
}
