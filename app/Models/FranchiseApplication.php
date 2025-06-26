<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FranchiseApplication extends Model
{
    protected $fillable = [
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'age',
        'email',
        'cell_number',
        'landline_number',
        'total_cash_invest',
        'own_cash_invest',
        'borrowed_funds',
        'borrow_from',
        'no_of_outlets',
        'areas_of_interest',
        'planned_opening_date',
        'business_experience',
        'additional_comments',
        'signature_data'
    ];

}
