<?php

namespace App\Http\Controllers\BranchUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Library\sHelper;
use App\Models\BranchSetting;

class SettingController extends Controller
{

    public function index()
    {
        $data['title'] = 'Branch | Settings';
        $data['settings'] = BranchSetting::where([['user_id', '=', Auth::user()->id]])->first();

        return view('branchuser.settings.create')->with($data);
    }

    public function store(Request $request)
    {
        BranchSetting::updateOrCreate(
            [ 'user_id' => Auth::user()->id ],
            [
                'user_id' => Auth::user()->id,
                'prefix_employee_id' => $request->prefix_employee_id,
            ]
        );


        // Redirect or return a response
        return redirect('branch-user/settings')->with([
            "alertMessage" => true,
            "alert" => ['message' => 'Branch added successfully', 'type' => 'success']
        ]);
    }
}
