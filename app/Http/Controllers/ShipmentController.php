<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Transhipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{


    public function trackShipment($builtiNumber)
    {
        $title = 'Track Shipment';
        $booking = Booking::where('bilti_number', $builtiNumber)
            ->orWhere('manual_bilty_number', $builtiNumber)
            ->first();

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found');
        }

        // Fetch all tracking updates ordered by sequence
        $trackingUpdates = Transhipment::where('booking_id', $booking->id)
            ->orderBy('sequence_no', 'asc')
            ->get();

        // Prepare timeline steps dynamically
        $steps = [];

        foreach ($trackingUpdates as $update) {
            $branchName = $update->branch ? $update->branch->branch_name : '';

            if ($update->type == 'sender') {
                // Sender step = Order Booked
                $steps[] = [
                    'branchName' => $branchName ?: 'Sender',
                    'name' => 'Order Booked',
                    'status' => $update->dispatched_at ? 'completed' : 'pending',
                    'dispatched_at' => formatDate($update->dispatched_at),
                    'received_at' => null,
                ];
            } elseif ($update->type == 'transhipment') {
                // Transhipment: Received first
                $steps[] = [
                    'branchName' => $branchName ?: 'Transhipment',
                    'name' => 'Received at ' . $branchName,
                    'status' => $update->received_at ? 'completed' : 'pending',
                    'dispatched_at' => null,
                    'received_at' => formatDate($update->received_at),
                ];

                // Transhipment: Dispatched after received
                $steps[] = [
                    'branchName' => $branchName ?: 'Transhipment',
                    'name' => 'Dispatched from ' . $branchName,
                    'status' => $update->dispatched_at ? 'completed' : 'pending',
                    'dispatched_at' => formatDate($update->dispatched_at),
                    'received_at' => null,
                ];
            } elseif ($update->type == 'receiver') {
                // Receiver step
                $steps[] = [
                    'branchName' => $branchName ?: 'Receiver',
                    'name' => 'Received at Receiver',
                    'status' => $update->received_at ? 'completed' : 'pending',
                    'dispatched_at' => formatDate($update->dispatched_at),
                    'received_at' => formatDate($update->received_at),
                ];
            }
        }
        return view('home.track-shipment', compact('booking', 'steps', 'title'));
    }

    public function trackItems(Request $request)
    {
        $data['title'] = 'Track Items';
        // Get the 'bilty-number' from query string
        $biltyNumber = $request->query('bilty-number');
        try {
            if ($biltyNumber) {
                $booking = Booking::where('bilti_number', $biltyNumber)
                    ->orWhere('manual_bilty_number', $biltyNumber)
                    ->first();

                if (!$booking) {
                    return redirect()->back()->with('error', 'Booking not found');
                }

                // Fetch tracking updates
                $trackingUpdates = Transhipment::where('booking_id', $booking->id)
                    ->orderBy('sequence_no', 'asc')
                    ->get();

                $steps = [];

                foreach ($trackingUpdates as $update) {

                    $branchName = $update->branch ? $update->branch->branch_name : '';

                    if ($update->type == 'sender') {

                        $steps[] = [
                            'branchName' => $branchName ?: 'Sender',
                            'name' => 'Order Booked',
                            'status' => $update->dispatched_at ? 'completed' : 'pending',
                            'dispatched_at' => formatDate($update->dispatched_at),
                            'received_at' => null,
                        ];
                    } elseif ($update->type == 'transhipment') {

                        // Received
                        $steps[] = [
                            'branchName' => $branchName ?: 'Transhipment',
                            'name' => 'Received at ' . $branchName,
                            'status' => $update->received_at ? 'completed' : 'pending',
                            'dispatched_at' => null,
                            'received_at' => formatDate($update->received_at),
                        ];

                        // Dispatched
                        $steps[] = [
                            'branchName' => $branchName ?: 'Transhipment',
                            'name' => 'Dispatched from ' . $branchName,
                            'status' => $update->dispatched_at ? 'completed' : 'pending',
                            'dispatched_at' => formatDate($update->dispatched_at),
                            'received_at' => null,
                        ];
                    } elseif ($update->type == 'receiver') {

                        $steps[] = [
                            'branchName' => $branchName ?: 'Receiver',
                            'name' => 'Received at Receiver',
                            'status' => $update->received_at ? 'completed' : 'pending',
                            'dispatched_at' => formatDate($update->dispatched_at),
                            'received_at' => formatDate($update->received_at),
                        ];
                    }
                }

                return view('frontend.search-shipment', $data, compact('booking', 'biltyNumber', 'steps'));
            } else {

                return view('frontend.track-shipment-item', $data);
            }
        } catch (\Exception $e) {
            return redirect(url('track-shipment'))->with('error', 'Something went wrong. Please try again.');
        }
    }
}
