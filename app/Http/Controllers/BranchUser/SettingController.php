<?php

namespace App\Http\Controllers\BranchUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\sHelper;
use App\Models\BranchSetting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
            ['user_id' => Auth::user()->id],
            [
                'user_id' => Auth::user()->id,
                'prefix_employee_id' => $request->prefix_employee_id ?: null,
                'freight_amount' => $request->freight_amount ?? 0,
                'wbc_charges' => $request->wbc_charges ?? 0,
                'handling_charges' => $request->handling_charges ?? 0,
                'fov_amount' => $request->fov_amount ?? 0,
                'fuel_amount' => $request->fuel_amount ?? 0,
                'transhipmen_amount' => $request->transhipmen_amount ?? 0,
                'hamali_Charges' => $request->hamali_Charges ?? 0,
                'bilti_Charges' => $request->bilti_Charges ?? 0,
                'compney_charges' => $request->compney_charges ?? 0,
                'cgst' => $request->cgst ?? 0,
                'sgst' => $request->sgst ?? 0,
                'igst' => $request->igst ?? 0,
            ]
        );

        return redirect('branch-user/settings')->with([
            "alertMessage" => true,
            "alert" => ['message' => 'Branch added successfully', 'type' => 'success']
        ]);
    }


    public function changePassword(Request $request)
    {
        $data['title'] = 'Branch | Change password';

        if ($request->method() == "GET") {
            return view('branchuser.settings.change-password')->with($data);
        }

        if ($request->method() == "POST") {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user = Auth::user();
            $user->password = Hash::make($request->password);
            if ($user->save()) {
                return redirect()->back()->with([
                    "alertMessage" => true,
                    "alert" => ['message' => 'Password updated successfully', 'type' => 'success']
                ]);
            }
        }
    }
}
