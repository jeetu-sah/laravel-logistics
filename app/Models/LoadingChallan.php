<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LoadingChallan extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'loading_challans';

    protected $fillable = [
        'id',
        'challan_number',
        'created_by',
        'deleted_at',
        'created_at',
        'updated_at',
    ];


}
