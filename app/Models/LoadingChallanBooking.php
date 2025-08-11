<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LoadingChallanBooking extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Specify the table name
    protected $table = 'loading_challan_booking';


    protected $fillable = [
        'id',
        'loading_challans_id',
        'booking_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function challan()
    {
        return $this->belongsTo(LoadingChallan::class, 'loading_challans_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
