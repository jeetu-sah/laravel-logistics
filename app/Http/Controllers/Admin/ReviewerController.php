<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewerController extends Controller
{
    public function index()
    {
        return view('admin.add-new-reviewers');
    }
    public function show()
    {
        return view('admin.reviewers-list');
    }
}
