<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Booking;


class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'branch_name',
        'branch_code',
        'owner_name',
        'contact',
        'gst',
        'country_name',
        'state_name',
        'city_name', // assuming this is the same as district_name in your form
        'address1',
        'address2',
        'user_status',
    ];


    /**
     * Get the comments for the blog post.
     */
    public function fromBookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'consignor_branch_id');
    }


}
