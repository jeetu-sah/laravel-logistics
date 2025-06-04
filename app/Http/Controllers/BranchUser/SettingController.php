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
            ['user_id' => Auth::user()->id],
            [
                'user_id' => Auth::user()->id,

                'prefix_employee_id' => $request->prefix_employee_id ?: 'NA',

                'freight_amount' => $request->freight_amount !== null && $request->freight_amount !== '' ? $request->freight_amount : '00',
                'wbc_charges' => $request->wbc_charges !== null && $request->wbc_charges !== '' ? $request->wbc_charges : '00',
                'handling_charges' => $request->handling_charges !== null && $request->handling_charges !== '' ? $request->handling_charges : '00',
                'fov_amount' => $request->fov_amount !== null && $request->fov_amount !== '' ? $request->fov_amount : '00',
                'fuel_amount' => $request->fuel_amount !== null && $request->fuel_amount !== '' ? $request->fuel_amount : '00',
                'transhipmen_amount' => $request->transhipmen_amount !== null && $request->transhipmen_amount !== '' ? $request->transhipmen_amount : '00',
                'hamali_Charges' => $request->hamali_Charges !== null && $request->hamali_Charges !== '' ? $request->hamali_Charges : '00',
                'bilti_Charges' => $request->bilti_Charges !== null && $request->bilti_Charges !== '' ? $request->bilti_Charges : '00',
                'compney_charges' => $request->compney_charges !== null && $request->compney_charges !== '' ? $request->compney_charges : '00',
                'cgst' => $request->cgst !== null && $request->cgst !== '' ? $request->cgst : '00',
                'sgst' => $request->sgst !== null && $request->sgst !== '' ? $request->sgst : '00',
                'igst' => $request->igst !== null && $request->igst !== '' ? $request->igst : '00',
            ]
        );

        return redirect('branch-user/settings')->with([
            "alertMessage" => true,
            "alert" => ['message' => 'Branch added successfully', 'type' => 'success']
        ]);
    }


}
