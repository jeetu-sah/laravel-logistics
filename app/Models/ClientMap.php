<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientMap extends Model
{
    use HasFactory;

    const TYPE_CONSIGNOR = 'as_consignor';
    const TYPE_CONSIGNEE = 'as_consignee';

    protected $table = 'client_branch_map';
    protected $fillable = [
        'id',
        'client_id',
        'branch_id',
        'status',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = ['deleted_at'];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }


    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
