<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'client_name',
        'client_address',
        'client_phone_number',
        'client_gst_number',
        'client_email',
        'client_aadhar_card',
        'status'
    ];
    protected $dates = ['deleted_at'];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'id');
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'client_branch_map', 'client_id', 'branch_id');
    }


    public function mappedClients()
    {
        return $this->belongsToMany(Client::class, 'client_to_client_map', 'from_client_id', 'to_client_id');
    }
}
