<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function clientIncomingBookingIndex()
    {
        $data['title'] = 'Client Bookings Reports';
        $data['branch'] = Branch::currentbranch();
        $data['combineClients'] = Branch::currentbranch()?->combineClients?->unique('id')?->values() ?? [];
        return view('admin.report.clients-incoming-reports', $data);
    }



    public function clientIncomingBookingReportsAjaxList(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        $branchId = Auth::user()->branch_user_id;
        $query = Booking::where([
            ['booking_status', '=', Booking::CLIENT_BOOKING],
            ['consignee_branch_id', '=', $branchId],
            ['status', '=', Booking::DELIVERED_TO_CLIENT],
        ]);



        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('from_clients.client_name', 'like', "%$search%")
                    ->orWhere('to_clients.client_name', 'like', "%$search%");
            });
        }

        $total = $query->count();

        $clients = $query->skip($start)->take($limit)->get();

        // Prepare data
        $rows = [];
        $data = [];

        foreach ($clients as $index => $client) {
            $row = [];
            $row['sn'] = $start + $index + 1;

            // Link to booking with from_client_id
            $row['client_ids'] =
                '<a href="' . url('admin/reports/clients/bookings/revenue', [
                    'fromId' => $client->from_client_id,
                    'toId' => $client->to_client_id
                ]) . '" class="btn btn-sm btn-warning">
                View Bookings
            </a>';


            $row['from_client_name'] = $client->from_client_name;

            $row['to_client_name'] = $client->to_client_name;
            $row['to_client_phone_number'] = $client->to_client_phone_number ?? '-';
            $row['to_branch_name'] = $client->to_branch_name ?? '-';

            $row['created_at'] = $client->created_at;
            $row['action'] = '<a href="' . url("admin/clients/edit/{$client->id}") . '" class="btn btn-primary">Edit</a>&nbsp;
            <a href="' . url("admin/clients/delete/{$client->id}") . '" class="btn btn-warning">Delete</a> ';
            $data[] = $row;
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data,
        ]);
    }

    public function clientOutgoingBookingIndex()
    {
        $data['title'] = 'Client Bookings Reports';
        $data['branch'] = Branch::currentbranch();
        $data['combineClients'] = Branch::currentbranch()?->combineClients?->unique('id')?->values() ?? [];
        return view('admin.report.clients-outgoing-reports', $data);
    }


    public function clientOutgoingBookingReportsAjaxList(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        $branchId = Auth::user()->branch_user_id;
        $query = Booking::where([
            ['booking_status', '=', Booking::CLIENT_BOOKING],
            ['consignor_branch_id', '=', $branchId],
            ['status', '=', Booking::DELIVERED_TO_CLIENT],
        ]);

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('from_clients.client_name', 'like', "%$search%")
                    ->orWhere('to_clients.client_name', 'like', "%$search%");
            });
        }

        $total = $query->count();

        $clients = $query->skip($start)->take($limit)->get();

        // Prepare data
        $rows = [];
        $data = [];

        foreach ($clients as $index => $client) {
            $row = [];
            $row['sn'] = $start + $index + 1;

            // Link to booking with from_client_id
            $row['client_ids'] =
                '<a href="' . url('admin/reports/clients/bookings/revenue', [
                    'fromId' => $client->from_client_id,
                    'toId' => $client->to_client_id
                ]) . '" class="btn btn-sm btn-warning">
                View Bookings
            </a>';


            $row['from_client_name'] = $client->from_client_name;

            $row['to_client_name'] = $client->to_client_name;
            $row['to_client_phone_number'] = $client->to_client_phone_number ?? '-';
            $row['to_branch_name'] = $client->to_branch_name ?? '-';

            $row['created_at'] = $client->created_at;
            $row['action'] = '<a href="' . url("admin/clients/edit/{$client->id}") . '" class="btn btn-primary">Edit</a>&nbsp;
            <a href="' . url("admin/clients/delete/{$client->id}") . '" class="btn btn-warning">Delete</a> ';
            $data[] = $row;
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data,
        ]);
    }




    public function outgoingBookingIndex()
    {
        $data['title'] = 'Bookings Reports';
        $data['branch'] = Branch::currentbranch();
        $data['branches'] = Branch::where('id', '!=', Auth::user()->branch_user_id)
            ->where('user_status', Branch::ACTIVE)
            ->get();

        return view('admin.report.outgoing-booking-report', $data);
    }



    public function outgoingBookingAjaxList(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        // Retrieve filter values
        $fromDate = $request->input('date_from');
        $toDate = $request->input('date_to') ?: now()->format('Y-m-d');
        $bookingType = $request->input('booking_type');
        $orderColumnIndex = $request->input('order')[0]['column'] ?? 0;
        $orderDirection = $request->input('order')[0]['dir'] ?? 'asc';

        $columns = [
            'sn',
            'bilti_number',
            'booking_date',
            'no_of_artical',
            'origin',
            'consignor_name',
            'destination',
            'consignee_name',
            'amount',
            'booking_type',
            'dispatch_date',
            'challan_number'
        ];


        $bookingQuery = Booking::where([
            ['booking_status', '!=', Booking::CLIENT_BOOKING],
            ['consignor_branch_id', '=', Auth::user()->branch_user_id],
            ['status', '=', Booking::DELIVERED_TO_CLIENT]
        ]);
        if ($fromDate && $toDate) {
            $bookingQuery->whereBetween('created_at', [$fromDate, $toDate]);
        }
        if (!empty($bookingType)) {
            $bookingQuery->where('booking_type', $bookingType);
        }
        if ($request->consignee_branch_id) {
            $bookingQuery->where('consignee_branch_id', $request->consignee_branch_id);
        }

        if ($orderColumnIndex !== null && isset($columns[$orderColumnIndex]) && $columns[$orderColumnIndex] !== 'sn') {
            $bookingQuery->orderBy($columns[$orderColumnIndex], $orderDirection);
        } else {
            $bookingQuery->orderBy('created_at', 'desc');
        }


        $totalRecords = $bookingQuery->count();
        $bookings = $bookingQuery->skip($start)->take($limit)->get();

        $rows = [];
        foreach ($bookings as $index => $booking) {
            $rows[] = [
                'sn' => $start + $index + 1,
                'bilti_number' => '<a href="' . url('/') . '" target="_blank">'
                    . ($booking->bilti_number ?? '')
                    . ($booking->manual_bilty_number ? ' / ' . $booking->manual_bilty_number : '')
                    . '</a>',
                'booking_date' => formatOnlyDate($booking->booking_date),
                'no_of_artical' => $booking->no_of_artical ?? '-',
                'origin' => $booking?->consignorBranch?->branch_name,
                'consignor_name' => $booking->consignor_name,
                'destination' => $booking?->consigneeBranch?->branch_name,
                'consignee_name' => $booking->consignee_name ?? '',
                'amount' => number_format($booking?->delivery_receipt?->grand_total, 2),
                'booking_type' => '<span class="badge badge-danger">' . $booking->booking_type . '</span>',
                'dispatch_date' => formatOnlyDate($booking?->first_transhipment->dispatched_at) ?? '-',
                'challan_number' => $booking->getSpecificBranchBookingChallan(Auth::user()?->branch_user_id)->challan_number ?? '-',
            ];
        }
        // Return the response in a structured way for DataTables
        return response()->json([
            'draw' => $request->input('draw'),  // This is for DataTables pagination
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,  // Modify this if you need to filter records count separately
            'data' => $rows
        ]);
    }



    public function incomingBookingIndex()
    {
        $data['title'] = 'Incoming Bookings Reports';
        $data['branches'] = Branch::where('id', '!=', Auth::user()->branch_user_id)
            ->where('user_status', Branch::ACTIVE)
            ->get();

        return view('admin.report.incoming-booking-report', $data);
    }

    public function incomingBookingAjaxList(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        // Retrieve filter values
        $fromDate = $request->input('date_from');
        $toDate = $request->input('date_to') ?: now()->format('Y-m-d');
        $bookingType = $request->input('booking_type');
        $orderColumnIndex = $request->input('order')[0]['column'] ?? 0;
        $orderDirection = $request->input('order')[0]['dir'] ?? 'asc';

        $columns = [
            'sn',
            'bilti_number',
            'booking_date',
            'no_of_artical',
            'origin',
            'consignor_name',
            'destination',
            'consignee_name',
            'amount',
            'booking_type',
            'dispatch_date',
            'challan_number'
        ];


        $bookingQuery = Booking::where([
            ['booking_status', '!=', Booking::CLIENT_BOOKING],
            ['consignee_branch_id', '=', Auth::user()->branch_user_id],
            ['status', '=', Booking::DELIVERED_TO_CLIENT]
        ]);
        if ($fromDate && $toDate) {
            $bookingQuery->whereBetween('created_at', [$fromDate, $toDate]);
        }
        if (!empty($bookingType)) {
            $bookingQuery->where('booking_type', $bookingType);
        }
        if ($request->consignee_branch_id) {
            $bookingQuery->where('consignee_branch_id', $request->consignee_branch_id);
        }

        if ($orderColumnIndex !== null && isset($columns[$orderColumnIndex]) && $columns[$orderColumnIndex] !== 'sn') {
            $bookingQuery->orderBy($columns[$orderColumnIndex], $orderDirection);
        } else {
            $bookingQuery->orderBy('created_at', 'desc');
        }


        $totalRecords = $bookingQuery->count();
        $bookings = $bookingQuery->skip($start)->take($limit)->get();

        $rows = [];
        foreach ($bookings as $index => $booking) {
            $rows[] = [
                'sn' => $start + $index + 1,
                'bilti_number' => '<a href="' . url('/') . '" target="_blank">'
                    . ($booking->bilti_number ?? '')
                    . ($booking->manual_bilty_number ? ' / ' . $booking->manual_bilty_number : '')
                    . '</a>',
                'booking_date' => formatOnlyDate($booking->booking_date),
                'no_of_artical' => $booking->no_of_artical ?? '-',
                'origin' => $booking?->consignorBranch?->branch_name,
                'consignor_name' => $booking->consignor_name,
                'destination' => $booking?->consigneeBranch?->branch_name,
                'consignee_name' => $booking->consignee_name ?? '',
                'amount' => number_format($booking?->delivery_receipt?->grand_total, 2),
                'booking_type' => '<span class="badge badge-danger">' . $booking->booking_type . '</span>',
                'dispatch_date' => formatOnlyDate($booking?->first_transhipment->dispatched_at) ?? '-',
                'challan_number' => $booking->getSpecificBranchBookingChallan(Auth::user()?->branch_user_id)->challan_number ?? '-',
            ];
        }
        // Return the response in a structured way for DataTables
        return response()->json([
            'draw' => $request->input('draw'),  // This is for DataTables pagination
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,  // Modify this if you need to filter records count separately
            'data' => $rows
        ]);
    }
}
