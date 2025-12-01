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

        // Retrieve filter values
        $fromDate = $request->input('date_from');
        $toDate = $request->input('date_to') ?: now()->format('Y-m-d');
        $bookingType = $request->input('booking_type');
        $clientId = $request->input('client_id');
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
            ['booking_status', '=', Booking::CLIENT_BOOKING],
            ['consignee_branch_id', '=', Auth::user()->branch_user_id],
            ['status', '=', Booking::DELIVERED_TO_CLIENT]
        ]);
        if ($fromDate && $toDate) {
            $bookingQuery->whereBetween('created_at', [$fromDate, $toDate]);
        }
        if (!empty($clientId)) {
            $bookingQuery->where('client_to_id', $clientId);
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
        $totalOutGoingBookingAmount = number_format($bookingQuery->get()?->sum('delivery_receipt.grand_total'), 2);

        $bookings = $bookingQuery->skip($start)->take($limit)->get();

        $rows = [];
        foreach ($bookings as $index => $booking) {
            $rows[] = [
                'sn' => $start + $index + 1,
                'bilti_number' => '<a href="' . url('/') . '" target="_blank">'
                    . ($booking->bilti_number ?? '')
                    . ($booking->manual_bilty_number ? ' / ' . $booking->manual_bilty_number : '')
                    . '</a>',
                'client_name' => $booking->client?->client_name ?? '-',
                'client_to_name' => $booking->clientTo?->client_name ?? '-',
                'client_origin_destination' => $booking->client?->client_name . ' / ' . $booking->clientTo?->client_name ?? '-',
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
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $rows,
            'total_amount' => $totalOutGoingBookingAmount,
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

        // Retrieve filter values
        $fromDate = $request->input('date_from');
        $toDate = $request->input('date_to') ?: now()->format('Y-m-d');
        $bookingType = $request->input('booking_type');
        $clientId = $request->input('client_id');
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
            ['booking_status', '=', Booking::CLIENT_BOOKING],
            ['consignor_branch_id', '=', Auth::user()->branch_user_id],
            ['status', '=', Booking::DELIVERED_TO_CLIENT]
        ]);
        if ($fromDate && $toDate) {
            $bookingQuery->whereBetween('created_at', [$fromDate, $toDate]);
        }
        if (!empty($bookingType)) {
            $bookingQuery->where('booking_type', $bookingType);
        }
        if (!empty($clientId)) {
            $bookingQuery->where('client_id', $clientId);
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
        $totalOutGoingBookingAmount = number_format($bookingQuery->get()?->sum('delivery_receipt.grand_total'), 2);

        $bookings = $bookingQuery->skip($start)->take($limit)->get();

        $rows = [];
        foreach ($bookings as $index => $booking) {
            $rows[] = [
                'sn' => $start + $index + 1,
                'bilti_number' => '<a href="' . url('/') . '" target="_blank">'
                    . ($booking->bilti_number ?? '')
                    . ($booking->manual_bilty_number ? ' / ' . $booking->manual_bilty_number : '')
                    . '</a>',
                'client_origin_destination' => $booking->client?->client_name . ' / ' . $booking->clientTo?->client_name ?? '-',
                'client_name' => $booking->client?->client_name ?? '-',
                'client_to_name' => $booking->clientTo?->client_name ?? '-',
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
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $rows,
            'total_amount' => $totalOutGoingBookingAmount,
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
        $totalOutGoingBookingAmount = number_format($bookingQuery->get()?->sum('delivery_receipt.grand_total'), 2);
        // echo "<pre>";
        // print_r($totalOutGoingBookingAmount);exit;

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
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $rows,
            'total_amount' => $totalOutGoingBookingAmount,
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
        $totalOutGoingBookingAmount = number_format($bookingQuery->get()?->sum('delivery_receipt.grand_total'), 2);
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
                'booking' => $booking,
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

        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $rows,
            'total_amount' => $totalOutGoingBookingAmount,
        ]);
    }
}
