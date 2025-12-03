<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\DeliveryReceipt;
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
                    'name' => 'Received at' . $branchName,
                    'status' => $update->received_at ? 'completed' : 'pending',
                    'dispatched_at' => formatDate($update->dispatched_at),
                    'received_at' => formatDate($update->received_at),
                ];
            }
        }

        // Add courier details
        $deliveryReceipt = DeliveryReceipt::with('branch')->where('booking_id', $booking->id)->first();
        if ($deliveryReceipt) {
            $steps[] = [
                'branchName' => $deliveryReceipt?->branch?->branch_name ?: 'Sender',
                'name' => 'Out of delivery',
                'carrier_by' => $deliveryReceipt->recived_by,
                'carrier_mobile' => $deliveryReceipt->reciver_mobile,
                'status' => $deliveryReceipt->created_at ? 'completed' : 'pending',
                'dispatched_at' => formatDate($deliveryReceipt->created_at),
                'received_at' => null,
            ];
        } else {
            $steps[] = [
                'branchName' => null,
                'name' => 'Out of delivery',
                'carrier_by' => null,
                'carrier_mobile' => null,
                'status' => 'pending',
                'dispatched_at' => null,
                'received_at' => null,
            ];
        }

        //add receiver details
        if (!empty($booking->receiver_name)) {
            $steps[] = [
                'branchName' => null,
                'name' => 'Delivered to customer',
                'recived_by' => $booking->receiver_name,
                'reciver_mobile' => $booking->receiver_mobile_number,
                'received_at' => $booking->received_at,
                'status' => 'completed',
                'dispatched_at' => formatDate($booking->received_at),
                'received_at' => null,
            ];
        } else {
            $steps[] = [
                'branchName' => null,
                'name' => 'Delivered to customer',
                'recived_by' => null,
                'reciver_mobile' => null,
                'received_at' => null,
                'status' => 'pending',
                'dispatched_at' => null,
                'received_at' => null,
            ];
        }

        return view('home.track-shipment', compact('booking', 'steps', 'title'));
    }
}
