<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\sHelper;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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

        return redirect()->back()->with(["msg" => "<div class='notice notice-success notice'><strong>Success </strong>  Setting change successfully !!! </div>"]);
    }

    public function store(Request $request)
    {
        try {
            foreach ($request->except('_token') as $key => $value) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            DB::commit();

            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Settings updated successfully', 'type' => 'success']
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Something went wrong: ' . $e->getMessage(), 'type' => 'danger']
            ]);
        }
    }

    public function index(Request $request)
    {
        $data['title'] = 'Admin | Settings';
        $data['settings'] = Setting::all();

        return view('admin.settings.list', $data);
    }

    public function create(Request $request)
    {
        $data['title'] = 'Admin | Settings | Create';
        $data['settings'] = Setting::pluck('value', 'key')->toArray();
       
        return view('admin.settings.create', $data);
    }
}
