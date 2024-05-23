<?php

namespace App\Http\Controllers;

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
}
