<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\ClientTransaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function index()
    {
        $data['title'] = 'Accounts | List';
        return view('admin.accounts.list', $data);
    }

    public function create()
    {
        $data['title'] = 'Accounts | Create';
        $data['branch'] = Branch::currentbranch();;
        $data['combineClients'] = Branch::currentbranch()->combineClients->unique('id')->values();

        return view('admin.accounts.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'branch_id'            => 'required|integer|exists:branches,id',
                'consignor_branch_id'  => 'required|integer|exists:branches,id', // assuming it's client_id
                'type'                 => 'required|in:debit,credit',
                'amount'               => 'required|numeric|min:0',
                'transaction_date'     => 'required|date',
                'remark'               => 'nullable|string|max:255',
            ]);

            $transaction = ClientTransaction::create([
                'branch_id'        => $validatedData['branch_id'],
                'client_id'        => $validatedData['consignor_branch_id'],
                'type'             => $validatedData['type'],
                'amount'           => $validatedData['amount'],
                'description'      => $validatedData['remark'],
                'transaction_date' => $validatedData['transaction_date'],
            ]);

            return redirect()->back()->with([
                'alertMessage' => true,
                'redirectBookingId' => $transaction->id,
                'alert' => ['message' => 'Transaction created successfully', 'type' => 'success'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (QueryException $e) {
            Log::error('DB Error while creating transaction: ' . $e->getMessage());

            return redirect()->back()->with([
                'alertMessage' => true,
                'alert' => ['message' => 'Database error occurred while creating transaction.', 'type' => 'danger'],
            ])->withInput();
        } catch (\Exception $e) {
            Log::error('Unexpected error: ' . $e->getMessage());

            return redirect()->back()->with([
                'alertMessage' => true,
                'alert' => ['message' => 'Something went wrong. Please try again.', 'type' => 'danger'],
            ])->withInput();
        }
    }


    public function list(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        $query = ClientTransaction::query();
        $query->where('branch_id', Auth::user()->branch_user_id);
        if ($search) {
            $query->where('id', 'like', "%$search%")
                ->orWhere('client_id', 'like', "%$search%");
        }
        $totalRecord = $query->count();
        $clientTransactions = $query->skip($start)->take($limit)->get();

        $rows = [];
        if ($clientTransactions->count() > 0) {
            foreach ($clientTransactions as $index => $transaction) {
                $row = [];
                $row['id'] = $transaction->id;
                $row['client_name'] = $transaction?->client?->client_name ?? '--';
                $row['type'] = $transaction?->type;
                $row['credit_amount'] = ($transaction->type == ClientTransaction::TYPE_CREDIT) ? $transaction->amount : '--';
                $row['debit_amount'] = ($transaction->type == ClientTransaction::TYPE_DEBIT) ? $transaction->amount : '--';
                $row['description'] = $transaction->description;
                $row['transaction_date'] = formatDate($transaction?->transaction_date);
                $row['created_at'] = formatDate($transaction->created_at);
                $row['action'] = '--';
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

        return response()->json($json_data);
    }
}
