<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LoadingChallanBooking extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'loading_challan_booking';

    protected $fillable = [
        'id',
        'loading_challans_id',
        'booking_id',
        'created_at',
        'updated_at',
    ];


}
