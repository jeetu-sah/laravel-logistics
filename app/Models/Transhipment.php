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


    //commision
    public function getCommisionAttribute()
    {
        if ($this->type === self::TYPE_SENDER && $this->booking) {
            $consigneeId = $this->booking->consignee_branch_id;
            $commisionPrice = BranchCommision::where('consignor_branch_id', $this->from_transhipment)
                ->where('consignee_branch_id', $consigneeId)
                ->first();
            if ($commisionPrice) {
                return $commisionPrice->amount * $this->booking?->no_of_artical;
            }
            return 0;
        } elseif ($this->type === self::TYPE_TRANSHIPMENT && $this->branch) {

            return $this->branch->transhipment_commission_price * $this->booking?->no_of_artical;
        } else if ($this->type === self::TYPE_RECEIVER && $this->booking) {

            return $this->branch->incoming_commission_price * $this->booking?->no_of_artical;
        }
    }
}
