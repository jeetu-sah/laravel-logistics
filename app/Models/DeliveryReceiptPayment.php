<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;


class DeliveryReceiptPayment extends Model
{
    use HasFactory;

    protected $table = 'delivery_receipt_payments';


    protected $fillable = [
        'delivery_receipt_id',
        'pending_amount',
        'received_amount',
        'notes',
    ];

    public function deliveryReceipt()
    {
        return $this->belongsTo(DeliveryReceipt::class);
    }


    public function booking(): HasOneThrough
    {
        return $this->hasOneThrough(
            Booking::class,
            DeliveryReceipt::class,
            'id',
            'id',
            'delivery_receipt_id',
            'booking_id'
        );
    }
}
