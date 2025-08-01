<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transhipment extends Model
{
    use HasFactory;

    const PENDING = 'pending';
    const RECEIVED = 'received';
    const DISPATCHED = 'dispatched';

    const TYPE_SENDER = 'sender';
    const TYPE_RECEIVER = 'receiver';
    const TYPE_TRANSHIPMENT = 'transhipment';


    protected $fillable = [
        'booking_id',
        'from_transhipment',
        'sequence_no',
        'updated_at',
        'received_at',
        'dispatched_at',
        'status',
        'type'
    ];

    // Relationship with Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }


    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'from_transhipment');
    }
}
