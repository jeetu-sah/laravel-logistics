<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchSetting extends Model
{
    use HasFactory;

    protected $table = 'branches_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'prefix_employee_id',
        'freight_amount',
        'wbc_charges',
        'handling_charges',
        'fov_amount',
        'fuel_amount',
        'transhipmen_amount',
        'hamali_Charges',
        'bilti_Charges',
        'compney_charges',
        'cgst',
        'sgst',
        'igst',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
