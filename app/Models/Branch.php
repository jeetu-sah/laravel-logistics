<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'branch';

    // Allow mass assignment for these fields
    protected $fillable = [
        'branch_name',
        'branch_code',
        'owner_name',
        'contact',
        'gst',
        'country_name',
        'state_name',
        'city_name',
        'address1',
        'address2',
        'user_status',
    ];
}
