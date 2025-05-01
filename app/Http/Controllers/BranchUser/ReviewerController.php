<?php

namespace App\Http\Controllers\BranchUser;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


class ReviewerController extends Controller
{
    public function index()
    {
        $data['title'] = 'Employee | Create';

        return view('branchuser.employee.create')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'mobile' => 'required|digits:10|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'position' => 'required|string',
                'department' => 'required|string',
                'password' => 'required',
                'user_status' => 'required|string',
            ],
            [
                // Custom error messages
                'first_name.required' => 'First name is required !!!',
                'last_name.required' => 'Last name is required !!!',
                'mobile.required' => 'Mobile number is required !!!',
                'mobile.digits' => 'Mobile number must be 10 digits !!!',
                'mobile.unique' => 'This mobile number is already registered !!!',
                'email.required' => 'Email field is required !!!',
                'email.email' => 'Please enter a valid email address !!!',
                'email.unique' => 'This email is already registered !!!',
                'degree.required' => 'User Degree field is required !!!',
                'institution.required' => 'Institution field is required !!!',
                'position.required' => 'Position field is required !!!',
                'department.required' => 'Department field is required !!!',
                'reason.required' => 'Reason field is required !!!',
                'user_type.required' => 'User type is required !!!',
                'password.required' => 'Password is required !!!',
                'password.min' => 'Password must be at least 8 characters !!!',
                'user_status.required' => 'User status is required !!!',
            ]
        );

        try {
            $user = new User([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'degree' => $request->degree,
                'institution' => $request->institution,
                'position' => $request->position,
                'department' => $request->department,
                'reason' => $request->comment,
                'user_type' => User::EMPLOYEE,
                'password' => Hash::make($request->password),
                'user_status' => $request->user_status,
                'term_and_condition' => 1,
                'branch_user_id' => Auth::user()->id
            ]);

            if ($user->save()) {

                //assigned roles
                $roles = Role::where('slug', 'employee')->get();
                $user->assignRole($roles);


                return redirect('/branch-user/employees')->with([
                    "alertMessage" => true,
                    "alert" => ['message' => 'Record addedd Successfully', 'type' => 'success']
                ]);
            }
        } catch (\Exception $e) {
            // Log the exception
            $e->getMessage();

            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Something went wrong, please try again', 'type' => 'danger']
            ]);
        }
    }



    public function show()
    {
        $data['title'] = 'Reviewer | List';
        return view('branchuser.employee.list')->with($data);
    }

    public function edit(Request $request, $id)
    {
        $data['title'] = 'Reviewer | Edit';
        $data['reviwer'] = User::with('roles')->find($id);
        $data['roles'] = Role::all();

        return view('branchuser.employee.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $data['title'] = 'Reviewer | update';
        $user = User::find($id);
        if ($user != NULL) {
            $user->first_name = $request->first_name ?? '';
            $user->last_name = $request->last_name ?? '';
            $user->email = $request->email ?? '';
            $user->mobile = $request->mobile ?? '';
            $user->user_status = $request->user_status ?? '';
            $user->position = $request->position ?? '';
            $user->department = $request->department ?? '';
            $user->reason = $request->comment ?? '';

            $user->save();

            //$roleIdArr = $request->roles;

            //unassigned, assigned roles
            // $assignedRoles = $user->roles;
            // if ($assignedRoles->count() > 0) {
            //     foreach ($assignedRoles as $assignedRole) {
            //         $user->removeRole($assignedRole);
            //     }
            // }

            //unassigned, assigned roles
            // if ($user != NULL) {
            //     if (count($roleIdArr) > 0) {
            //         //assigned, assigned roles
            //         $roles = Role::whereIn('id', $roleIdArr)->get();
            //         $user->assignRole($roles);
            //     }
            // }

            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Record update Successfully', 'type' => 'success']
            ]);
        } else {
            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Something went wrong, please try again', 'type' => 'danger']
            ]);
        }
    }

    public function list(Request $request)
    {
        $limit = request()->input('length');
        $start = request()->input('start');
        $totalRecord = User::count();

        $usersQuery = User::query();
        $usersQuery = $usersQuery->where([
            ['user_type', '=', User::EMPLOYEE],
            ['branch_user_id', '=', Auth::user()->id]
        ]);
        $users = $usersQuery->skip($start)->take($limit)->get();

        $rows = [];
        if ($users->count() > 0) {
            $i = 1;
            foreach ($users as $user) {
                $change_credential = NULL;
                $edit_btn = '<a href="' . url("branch-user/employees/edit/" . $user->id) . '" data-toggle="tooltip" title="Edit Record" class="btn btn-primary" style="margin-right: 5px;">
						<i class="fas fa-edit"></i> 
					  </a>';

                //if(Auth::user()->isAbleTo('change-user-credential')){
                $change_credential = '';
                // $change_credential = '<a href="' . url("admin/edit_credential/" . $user->id) . '" data-toggle="tooltip" title="Edit Record" class="btn btn-success" style="margin-right: 5px;">
                // 		<i class="fas fa-key"></i> 
                // 	  </a>';
                //}
                $row = [];
                $row['sn'] = '<a href="' . url("branch-user/employees/edit/$user->id") . '">' . $user->userId . '</a>';
                ;

                $row['name'] = $user->first_name;
                $row['email'] = $user->email;
                $row['mobile'] = $user->mobile;
                $row['user_type'] = $user->user_type;
                $row['user_status'] = $user->user_status;

                $row['action'] = $edit_btn . " " . $change_credential;

                $rows[] = $row;
            }
        }

        $json_data = array(
            "draw" => intval(request()->input('draw')),
            "recordsTotal" => intval($totalRecord),
            "recordsFiltered" => intval($totalRecord),
            "data" => $rows
        );
        // echo "<pre>";
        // print_r($json_data);exit;
        return json_encode($json_data);
        exit;
    }
}
