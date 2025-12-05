<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\sHelper;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class AdminBookingController extends Controller
{
    public function index()
    {
        $data['title'] = 'Admin Booking Management';
        return view('admin.admin-booking.list', $data);
    }

    public function list(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        // Start of query
        $bookingQuery = Booking::with(['client', 'consigneeBranch', 'consigneeBranch']);
        // Search functionality
        if ($search) {
            $bookingQuery->where('bilti_number', 'like', "%$search%")
                ->orWhere('consignor_name', 'like', "%$search%")
                ->orWhere('consignee_name', 'like', "%$search%")
                ->orWhere('manual_bilty_number', 'like', "%$search%");
        }
        // Count the total records
        $totalRecord = $bookingQuery->count();

        // Apply pagination and order
        $bookings = $bookingQuery->skip($start)->take($limit)->orderBy('bookings.created_at', 'desc')->get();

        $rows = [];
        if ($bookings->count() > 0) {
            foreach ($bookings as $index => $booking) {
                $row = [];
                $row['bilti_number'] = '<a href="' . route('bookings.bilti', ['id' => $booking->id]) . '" target="_blank">' . $booking->bilti_number . '</a>';
                $row['offline_bilti'] = ($booking->manual_bilty_number ?? '--') . "/" . ($booking->offline_booking_date ? formatOnlyDate($booking->offline_booking_date) : '--');

                // Consignor and consignee information
                $row['consignor_branch_id'] = $booking?->consignorBranch?->branch_name ?? 'N/A';
                $row['booking'] = $booking;
                $row['no_of_artical'] = $booking->no_of_artical ?? 0;
                $row['grand_total_amount'] = format_price($booking->grand_total_amount);
                $row['consignor_name'] = $booking->consignor_name ?? 'N/A';
                $row['address'] = $booking->consignor_address ?? 'N/A';
                $row['gst_number'] = $booking->gst_number ?? 'N/A';
                $row['consignee_branch_id'] = $booking?->consigneeBranch?->branch_name ?? 'N/A';
                $row['consignee_name'] = $booking->consignee_name;
                $row['consignee_address'] = $booking->consignee_address;
                $row['booking_type'] = '<span class="badge badge-danger">' . $booking->booking_type . '</span>';
                $row['next_delivery_location'] = '<span class="badge badge-primary">' . $booking?->next_booking_transhipment?->branch?->branch_name ?? '--' . '</span>';
                $row['action'] = '<div class="dropdown">
                    <button class="btn btn-light btn-sm" type="button" id="actionMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-list"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="actionMenu2">
                        <li>
                            <a class="dropdown-item text-danger deleteBooking" href="' . url('admin/admin-bookings/delete/' . $booking->id) . '">
                                <i class="fas fa-trash me-2"></i> Delete
                            </a>
                        </li>
                    </ul>
                </div>';

                $row['created_at'] = formatDate($booking->created_at);
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
    }


    public function delete($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->back()->with([
            "alertMessage" => true,
            "redirectBookingId" => $booking->id,
            "redirectAnotherRoute" => true,
            "alert" => ['message' => 'Booking created successfully', 'type' => 'success']
        ]);
        return redirect()->back()->with([
            'alertMessage' => true,
            'alert' => ['message' => 'Booking deleted successfully', 'type' => 'success']
        ]);
    }
}
