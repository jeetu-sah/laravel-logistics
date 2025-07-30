<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTransaction extends Model
{
    use HasFactory;

    protected $table = 'client_transaction';
    protected $fillable = [
        'id',
        'branch_id',
        'client_id',
        'type',
        'amount',
        'description',
        'transaction_date',
        'updated_at',
        'deleted_at',
    ];

    const TYPE_CREDIT = 'credit';
    const TYPE_DEBIT = 'debit';
    

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
