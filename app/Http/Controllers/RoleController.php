<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $data['heading'] = 'Add Role';
        $data['listUrl'] = 'admin/role-list';

        return view('admin.authorization.add-role')->with($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name'
        ]);
        Role::create(['name' => $request->name]);
        return redirect('admin/role-list')->with('status', 'role Create Successfully');
    }

    public function show(Request $request)
    {
        $data['role'] = Role::paginate(10);
        $data['heading'] = 'Role List';
        $data['list'] = 'Role List';
        $data['addroleURL'] = 'admin/role';
        $data['btnName'] = 'Add role';
        return view('admin.authorization.role-list')->with($data);
    }


    public function list(Request $request)
    {
        $limit = request()->input('length');
        $start = request()->input('start');
        $totalRecord = Role::count();

        $rolesQuery = Role::query();
        $roles = $rolesQuery->skip($start)->take($limit)->get();

        $rows = [];
        if ($roles->count() > 0) {
            $i = 1;
            foreach ($roles as $role) {
                $row = [];
                $row['sn'] = '<a href="' . url("admin/roles/user_permission/$role->id?page=roles") . '">' . $role->id . '</a>';;

                $row['name'] = $role->name;
                $row['slug'] = $role->slug;
                $row['guard'] = $role->guard_name;
                $row['created_at'] = Carbon::parse($role->craeted_at)->format('d/m/Y'); //->format();
        
                $rows[] = $row;
            }
        }

        $json_data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($totalRecord),
            "recordsFiltered" => intval($totalRecord),
            "data"            => $rows
        );
        // echo "<pre>";
        // print_r($json_data);exit;
        return json_encode($json_data);
        exit;
    }
}
