<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use App\Models\BranchCommision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Branch list';
        return view('admin.branch.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['countries'] = DB::table('countries')->whereIn('code', ['NP', 'IN'])->get();
        $data['states'] = DB::table('country_states')->get();
        return view('admin.branch.create', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function commision($id)
    {
        $data['title'] = 'Branch list | commision';
        $data['branch'] = Branch::with(['user', 'incomingCommisions', 'outgoingCommisions'])->find($id);
        $data['branches'] = Branch::where('id', '!=', $id)->get();

        return view('admin.branch.commision', $data);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'branch_name' => 'required|string|max:255',
            'branch_code' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'gst' => 'required|string|max:255',
            'country_name' => 'required|string',
            'state_name' => 'required|integer',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'user_status' => 'required|string',
            'loginId' => 'required',
            'password' => 'required',
        ]);

        // Create a new Branch instance and save the data
        $branch = Branch::create([
            'branch_name' => $request->input('branch_name'),
            'branch_code' => $request->input('branch_code'),
            'owner_name' => $request->input('owner_name'),
            'contact' => $request->input('contact'),
            'gst' => $request->input('gst'),
            'country_name' => $request->input('country_name'),
            'state_name' => $request->input('state_name'),
            'city_name' => $request->input('district_name'),
            'address1' => $request->input('address1'),
            'address2' => $request->input('address2'),
            'user_status' => $request->input('user_status'),
            'incoming_commission_price' => $request->input('incoming_commission_price'),
            'transhipment_commission_price' => $request->input('transhipment_commission_price'),
        ]);

        if ($branch) {
            User::create([
                'first_name' => $branch->branch_name,
                'last_name' => $branch->owner_name,
                'email' => $request->loginId,
                'email_verified_at' => Carbon::now(),
                'mobile' => $branch->contact,
                'mobile_verified_at' => Carbon::now(),
                'password' => Hash::make($request->password),
                'identity' => ($request->password),
                'user_type' => 'branch-user',
                'user_status' => 'active',
                'term_and_condition' => 1,
                'branch_user_id' => $branch->id,
            ]);
            // Redirect or return a response
            return redirect('admin/branches')->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Branch created successfully', 'type' => 'success']
            ]);
        } else {
            return redirect('admin/branches')->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Something went wrong, please try again', 'type' => 'danger']
            ]);
        }
    }

    public function list(Request $request)
    {

        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        // Get total record count
        $totalRecord = Branch::count(); // Simplified to directly get the count

        // Create a query builder instance and apply pagination
        $branches = Branch::skip($start)->take($limit)->get();

        $rows = [];
        if ($branches->count() > 0) {
            foreach ($branches as $index => $branch) {
                $row = [];
                $row['sn'] = $start + $index + 1; // Corrected SN to start from the current page's start index
                $row['branch_name'] = $branch->branch_name;
                $row['branch_code'] = '<a href="' . url("admin/branches/edit/{$branch->id}") . '">' . $branch->branch_code . '</a>';
                $row['owner_name'] = $branch->owner_name;
                $row['contact'] = $branch->contact;
                $row['gst'] = $branch->gst;
                $row['user_status'] = $branch->user_status;
                $row['identity'] = $branch?->user?->identity ?? '--';
                $row['action'] = '
                <div class="dropdown">
                    <button class="btn btn-light btn-sm" type="button" id="actionMenu' . $branch->id . '" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-list"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="actionMenu' . $branch->id . '">
                       <li>
                            <a class="dropdown-item" href="' . url("admin/branches/edit/{$branch->id}") . '">
                                <i class="fas fa-pencil-alt me-2"></i> Edit
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href="' . url("admin/branches/deletebranch/{$branch->id}") . '" onclick="return confirm(\'Are you sure you want to soft delete this branch?\')">
                                <i class="fas fa-trash me-2"></i> Delete
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-success" href="' . url("admin/branches/commision/{$branch->id}") . '">
                                <i class="fas fa-percent me-2"></i> Set Commisions
                            </a>
                        </li>
                    </ul>
                </div>';

                $row['created_at'] = formatDate($branch->created_at);

                $rows[] = $row;
            }
        }

        // Prepare the JSON response with correct record counts
        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalRecord,
            "recordsFiltered" => $totalRecord, // Adjust this if you implement search/filter functionality
            "data" => $rows,
        ];

        return response()->json($json_data); // Return a JSON response
    }

    /**
     * Display the specified resource.
     */
    public function storeCommision(Request $request, $id)
    {
        try {
            $request->validate([
                'branch_name'        => 'required|array|min:1',
                'branch_name.*'      => 'exists:branches,id|different:' . $id,
                'commission_amount'  => 'required|array',
            ]);

            foreach ($request->branch_name as $branchId) {

                $amount = $request->commission_amount[$branchId] ?? null;
                if ($amount) {
                    BranchCommision::updateOrCreate(
                        [
                            'consignor_branch_id' => $id,
                            'consignee_branch_id' => $branchId,
                            'type' => $request->type,
                        ],
                        [
                            'amount'   => $amount,
                            'status'   => 'active',
                            'type' => $request->type,
                        ]
                    );
                }
            }

            return redirect()->back()
                ->with([
                    "alertMessage" => true,
                    "alert" => ['message' => 'Branch commissions set successfully', 'type' => 'success'],
                    "activeTab" => request('type')
                ])
                ->withInput();
        } catch (\Exception $e) {
            Log::error("Error saving branch commission: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with([
                    "alertMessage" => true,
                    "alert" => ['message' => 'Something went wrong while saving commissions. Please try again.', 'type' => 'danger'],
                    "activeTab" => request('type')
                ])->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['title'] = 'Edit Branch';
        $data['branch'] = Branch::with('user')->find($id);
        $data['countries'] = DB::table('countries')->whereIn('code', ['NP', 'IN'])->get();
        return view('admin.branch.edit', $data);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branches)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'branch_name' => 'required|string|max:255',
            'branch_code' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'gst' => 'required|string|max:255',
            'country_name' => 'required|string',
            'state_name' => 'required|integer',
            'district_name' => 'required|integer',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'user_status' => 'required|string',
            'password' => 'required|string|min:6', // Ensure password is included in validation
        ]);

        DB::beginTransaction();

        try {
            $branch = Branch::find($id);
            if (!$branch) {
                throw new \Exception('Branch not found');
            }

            $branch->branch_name = $request->branch_name;
            $branch->branch_code = $request->branch_code;
            $branch->owner_name = $request->owner_name;
            $branch->contact = $request->contact;
            $branch->gst = $request->gst;
            $branch->country_name = $request->country_name;
            $branch->state_name = $request->state_name;
            $branch->city_name = $request->district_name;
            $branch->address1 = $request->address1;
            $branch->address2 = $request->address2;
            $branch->user_status = $request->user_status;
            $branch->incoming_commission_price = $request->incoming_commission_price;
            $branch->transhipment_commission_price = $request->transhipment_commission_price;
            $branch->save();

            $user = $branch->user;
            if (!$user) {
                throw new \Exception('Associated user not found');
            }

            $user->identity = $request->password;
            $user->password = Hash::make($request->password);
            $user->save();

            DB::commit();

            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => ['message' => 'Branch updated successfully', 'type' => 'success']
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with([
                "alertMessage" => true,
                "alert" => [
                    'message' => 'Something went wrong, please try again. Error: ' . $e->getMessage(),
                    'type' => 'danger'
                ]
            ]);
        }
    }

    public function deletebranch($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();
        return redirect('admin/branches')->with('success', 'Branch deleted successfully.');
    }
}
