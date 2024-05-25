<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Event\TestRunner\ExecutionAborted;
use Illuminate\Support\Facades\Auth;

class ReviewerController extends Controller
{
    public function index()
    {
        $data['title'] = 'Reviewer | Create';
        return view('admin.reviewer.create')->with($data);
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
        $data['allUsers'] = User::paginate(10);

        $data['title'] = 'Reviewer | List';
        return view('admin.reviewer.list')->with($data);
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
                $delete_btn =  "<a href='javascript::void()' data-partnerid='" . $user->id . "' data-toggle='tooltip' title='Add category' class='btn btn-danger remove_partner' style='margin-right: 5px;'><i class='fas fa-trash'></i></a>&nbsp;";

                $edit_btn = '<a href="#" data-toggle="tooltip" title="Edit Record" class="btn btn-primary" style="margin-right: 5px;">
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

                $row['action'] = $delete_btn . ' ' . $edit_btn . " " . $change_credential;

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
