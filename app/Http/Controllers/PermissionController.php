<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $data['heading'] = 'Add Permission';
        $data['listUrl'] = 'admin/permission-list';

        return view('admin.add-permission')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name'
        ]);
        Permission::create(['name' => $request->name]);
        return redirect('admin/permission-list')->with('status', 'Permission Create Successfully');
    }
    public function show(Request $request)
    {
        $data['permission'] = Permission::paginate(10);
        $data['heading'] = 'Permission List';
        $data['list'] = 'Permission List';
        $data['addpermissionURL'] = 'admin/permission';
        $data['btnName'] = 'Add Permission';
        return view('admin.permission-list')->with($data);
    }
}
