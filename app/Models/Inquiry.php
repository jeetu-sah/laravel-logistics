<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'state_id',
        'district_id',
        'destination_state_id',
        'destination_district_id',
        'description',
        'status'
    ];
}
