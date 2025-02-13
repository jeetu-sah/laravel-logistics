<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Distances extends Model
{
    use HasFactory;
    use  SoftDeletes;

    protected $fillable = [
        'from_branch_id',
        'to_branch_id',
        'distance',
        'status',
    ];

    // Optionally, you can specify the name of the deleted_at column if it's different
     protected $dates = ['deleted_at']; // Uncomment this line if necessary
}
