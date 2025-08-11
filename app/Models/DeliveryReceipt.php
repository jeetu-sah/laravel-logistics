<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryReceipt extends Model
{
    use HasFactory;

    // The table associated with the model (optional if you use Laravel's naming conventions)
    protected $table = 'delivery_receipts';

    // The attributes that are mass assignable
    protected $fillable = [
        'id',
        'booking_id',
        'freight_charges',
        'hamali_charges',
        'demruge_charges',
        'others_charges',
        'received_amount',
        'pending_amount',
        'grand_total',
        'recived_by',
        'reciver_mobile',
        'parcel_image',
        'delivery_number',
        'discount',
        'remark',
        'branch_id',
        'status',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function payments()
    {
        return $this->hasMany(DeliveryReceiptPayment::class, 'delivery_receipt_id');
    }

    public function bookingPendingAmount()
    {
        $totalReceived = $this->payments->sum('received_amount');

        $pendingAmount = max(0, (float) $this->grand_total - $totalReceived);
        return number_format($pendingAmount, 2) ?? '0.0';
    }

    public function bookingReceivedAmount()
    {
        $totalReceived = $this->payments->sum('received_amount');
        $receivedAmount =  max(0, (float) $totalReceived);
        return number_format($receivedAmount, 2) ?? '0.0';
    }
}
