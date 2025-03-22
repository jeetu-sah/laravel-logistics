<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{


    public function trackShipment(Request $request)
    {
        // Validate the shipment number
        $request->validate([
            'shipment_number' => 'required|string',
        ]);

        // Assuming you have a Booking model for the shipments
        $shipment = Booking::where('bilti_number', $request->shipment_number)
            ->orWhere('manual_bilty_number', $request->shipment_number)
            ->first();


        if ($shipment) {
            // Return a successful response with tracking data
            return response()->json([
                'success' => true,
                'status' => $shipment->status, // Assuming status is stored as a number (1, 2, 3, or 4)
            ]);
        } else {
            // If shipment not found, return an error response
            return response()->json([
                'success' => false,
                'message' => 'Shipment not found.',
            ]);
        }
    }



}
