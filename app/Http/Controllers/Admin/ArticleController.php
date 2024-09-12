<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleType;
use App\Models\ItemType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class ArticleController extends Controller
{
    public function index()
    {
        $data['title'] = 'Article | Create';
        $data['articleTypes'] = ArticleType::all();
        $data['itemTypes'] = ItemType::all();
        $data['reviewers'] = User::all();

        return view('admin.article.create')->with($data);
    }

    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'mobile' => 'required|digits:10|unique:users',
                    'email' => 'required|string|email|max:255|unique:users',
                    'user_type' => 'required',
                    'password' => 'required|min:8',
                    'user_status' => 'required|string',
                ],
                [
                    // Custom error messages
                    'first_name.required' => 'First name is required.',
                    'last_name.required' => 'Last name is required.',
                    'mobile.required' => 'Mobile number is required.',
                    'mobile.digits' => 'Mobile number must be 10 digits.',
                    'mobile.unique' => 'This mobile number is already registered.',
                    'email.required' => 'Email is required.',
                    'email.email' => 'Please enter a valid email address.',
                    'email.unique' => 'This email is already registered.',
                    'user_type.required' => 'User type is required.',
                    'password.required' => 'Password is required.',
                    'password.min' => 'Password must be at least 8 characters.',
                    'user_status.required' => 'User status is required.',
                ]
            );

            $user = new User([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'user_type' => $request->user_type,
                'password' => Hash::make($request->password),
                'user_status' => $request->user_status,
                'term_and_condition' => 1,
            ]);

            $user->save();

            // Redirect to the reviewers list with a success message
            return redirect()->route('admin/reviewers-list')->with('success', 'New employee added successfully!');
        } catch (\Exception $e) {
            // Log the exception
            $e->getMessage();

            // Redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }



    public function show()
    {
        $data['title'] = 'Reviewer | List';
        return view('admin.reviewer.list')->with($data);
    }

    public function edit(Request $request, $id)
    {
        $data['title'] = 'Reviewer | Edit';
        $data['reviwer'] = User::with('roles')->find($id);
        $data['roles'] = Role::all();
      
        return view('admin.reviewer.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $data['title'] = 'Reviewer | update';
        $user = User::find($id);
        if($user != NULL) {
            $user->first_name = $request->first_name ?? '';
            $user->last_name = $request->last_name ?? '';
            $user->email = $request->email ?? '';
            $user->mobile = $request->mobile ?? '';
            $user->user_type = $request->user_type ?? '';
            $user->user_status = $request->user_status ?? '';
            $user->save(); 

            $roleIdArr = $request->roles;
    
            //unassigned, assigned roles
            $assignedRoles = $user->roles;
            if($assignedRoles->count() > 0) {
                foreach($assignedRoles as $assignedRole) {
                    $user->removeRole($assignedRole);
                }
            }
    
            if($user != NULL) {
                if(count($roleIdArr) > 0) {
                    //assigned, assigned roles
                    $roles = Role::whereIn('id', $roleIdArr)->get();
                    $user->assignRole($roles);
                }
            }
    
            return redirect()->back()->with(["msg"=>"<div class='callout callout-success'><strong>Success </strong>  Record update Successfully  !!! </div>"]); 
        } else{
            return redirect()->back()->with(["msg"=>"<div class='callout callout-info'><strong>Info </strong>  Something went wrong, please try again.  !!! </div>"]); 
        }
    }

    public function list(Request $request)
    {
        $limit = request()->input('length');
        $start = request()->input('start');
        $totalRecord = User::count();

        $usersQuery = User::query();
        $users = $usersQuery->skip($start)->take($limit)->get();

        $row = [];
        if ($users->count() > 0) {
            $i = 1;
            foreach ($users as $user) {
                $change_credential = NULL;
                $edit_btn = '<a href="' . url("admin/reviewers/edit/" . $user->id) . '" data-toggle="tooltip" title="Edit Record" class="btn btn-primary" style="margin-right: 5px;">
						<i class="fas fa-edit"></i> 
					  </a>';

                //if(Auth::user()->isAbleTo('change-user-credential')){
                $change_credential = '<a href="' . url("admin/edit_credential/" . $user->id) . '" data-toggle="tooltip" title="Edit Record" class="btn btn-success" style="margin-right: 5px;">
						<i class="fas fa-key"></i> 
					  </a>';
                //}
                $row = [];
                $row['sn'] = '<a href="' . url("admin/roles/user_permission/$user->id?page=roles") . '">' . $user->id . '</a>';;

                $row['name'] = $user->first_name;
                $row['email'] = $user->email;
                $row['mobile'] = $user->mobile;
                $row['user_type'] = $user->user_type;

                $row['action'] = $edit_btn . " " . $change_credential;

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
