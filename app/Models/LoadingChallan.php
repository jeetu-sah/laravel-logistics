<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;



class LoadingChallan extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'loading_challans';

    protected $fillable = [
        'id',
        'challan_number',
        'busNumber',
        'driverName',
        'driverMobile',
        'locknumber',
        'coLoder',
        'created_by',
        'deleted_at',
        'created_at',
        'updated_at',
    ];



    /**
     * Get the user that owns the phone.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
