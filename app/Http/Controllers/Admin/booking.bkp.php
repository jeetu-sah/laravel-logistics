<?php

public function list(Request $request)
{
    $search = $request->input('search')['value'] ?? null;
    $limit = $request->input('length', 10);
    $start = $request->input('start', 0);

    // Start of query
    $bookingQuery = Booking::query();

    // Joining the clients table
    $bookingQuery->join('clients', 'clients.id', '=', 'bookings.client_id');

    // Filter by branch
    $bookingQuery->where('consignor_branch_id', Auth::user()->branch_user_id);

    // Search functionality
    if ($search) {
        $bookingQuery->where('bilti_number', 'like', "%$search%")
            ->orWhere('consignor_name', 'like', "%$search%")
            ->orWhere('consignee_name', 'like', "%$search%")
            ->orWhere('clients.client_name', 'like', "%$search%"); // Added client name search
    }

    // Status filter
    $bookingQuery->where('bookings.status', Booking::BOOKED);

    // Count the total records
    $totalRecord = $bookingQuery->count();

    // Apply pagination and order
    $bookings = $bookingQuery->skip($start)->take($limit)->orderBy('bookings.created_at', 'desc')->get();
    echo "<pre>";
    print_r($bookings);exit;
    $rows = [];
    if ($bookings->count() > 0) {
        foreach ($bookings as $index => $booking) {
            $row = [];
            if ($request->bilti_list_type === 'challan') {
                $row['sn'] = '<div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="bookingId[]" value="' . $booking->id . '">
                                    <label class="form-check-label" for="exampleCheck1"></label>
                                </div>';
            } else {
                $row['sn'] = $start + $index + 1;
            }

            // Bilti and offline bilti links
            $row['bilti_number'] = '<a href="' . route('bookings.bilti', ['id' => $booking->id]) . '" target="_blank">' . $booking->bilti_number . '</a>';
            $row['offline_bilti'] = $booking->manual_bilty_number
                ? '<a href="' . route('bookings.bilti', ['id' => $booking->id]) . '" target="_blank">' . $booking->manual_bilty_number . '</a>'
                : '-';

            // Consignor and consignee information
            $row['consignor_branch_id'] = $booking?->consignorBranch?->branch_name;
            $row['consignor_name'] = $booking->consignor_name;
            $row['address'] = $booking->consignor_address;
            $row['phone_number_1'] = $booking->phone_number_1;
            $row['gst_number'] = $booking->gst_number;
            $row['consignee_branch_id'] = $booking?->consigneeBranch?->branch_name;
            $row['consignee_name'] = $booking->client_name;
            $row['consignee_address'] = $booking->client_address;
            $row['consignee_phone_number_1'] = $booking->client_phone_number;

            // Booking type
            if ($booking->booking_type == 'Paid') {
                $row['booking_type'] = 'Paid ';
            } elseif ($booking->booking_type == 'Topay') {
                $row['booking_type'] = 'To Pay ';
            } elseif ($booking->booking_type == 3) {
                $row['booking_type'] = 'Client ';
            } else {
                $row['booking_type'] = 'Unknown';
            }

            // Actions (Edit and Print)
            $row['action'] = '<a href="' . url("admin/bookings/edit/{$booking->id}") . '" class="btn btn-primary">Edit</a>&nbsp;<a href="' . url("admin/bookings/bilti/{$booking->id}") . '" class="btn btn-warning">Print</a>';

            // Date formatting
            $row['created_at'] = date('d-m-Y', strtotime($booking->created_at));

            // Add the row to the rows array
            $rows[] = $row;
        }
    }

    // Return the response with the rows and total record count
    return response()->json([
        'draw' => $request->input('draw'),
        'recordsTotal' => $totalRecord,
        'recordsFiltered' => $totalRecord,
        'data' => $rows,
    ]);
}?>