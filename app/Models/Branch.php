<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Booking;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory; use SoftDeletes;
    protected $dates = ['deleted_at'];
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
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id'); // assuming state_id is the foreign key in Branch
    }


}
