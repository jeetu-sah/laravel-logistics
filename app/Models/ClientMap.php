<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ClientMap extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'client_branch_map';
    protected $fillable = [
        'client_id',
        'client_branch_id',
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
