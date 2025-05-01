<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'full_name',
        'mobile',
        'email',
        'address',
        'gender',
        'why_hire',
        'resume',
    ];
}
