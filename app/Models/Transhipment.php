<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transhipment extends Model
{
    use HasFactory;

    const PENDING = 'pending';
    const RECEIVED = 'received';


    protected $fillable = [
        'booking_id',
        'from_transhipment',
        'to_transhipment',
        'sequence_no',
        'amount'
    ];

    // Relationship with Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
