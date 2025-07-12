<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'id',
        'key',
        'value',
        'created_at',
        'updated_at'
    ];

    public $settingLabels = [
        'freight_amount'      => 'Freight Amount',
        'wbc_charges'         => 'WBC Charges',
        'handling_charges'    => 'Handling Charges',
        'fov_amount'          => 'FOV Amount',
        'fuel_amount'         => 'Fuel Amount',
        'transhipmen_amount'  => 'Transhipment Amount',
        'hamali_Charges'      => 'Hamali Charges',
        'bilti_Charges'       => 'Bilti Charges',
        'compney_charges'     => 'Company Charges',
        'cgst'                => 'CGST',
        'sgst'                => 'SGST',
        'igst'                => 'IGST',
    ];


    public function getKeyNameAttribute()
    {


        return $this->settingLabels[$this->key] ?? ucwords(str_replace(['_', '-'], ' ', $this->key));
    }
}
