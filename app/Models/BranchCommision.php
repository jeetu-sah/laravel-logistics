<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchCommision extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'branch_commisions';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'consignor_branch_id',
        'consignee_branch_id',
        'amount',
        'type',
        'status'
    ];

    /**
     * Commission types.
     */
    public const TYPE_OUTGOING = 'outgoing';
    public const TYPE_INCOMING = 'incoming';

    /**
     * Get the consignor branch.
     */
    public function consignorBranch()
    {
        return $this->belongsTo(Branch::class, 'consignor_branch_id');
    }

    /**
     * Scope for outgoing commissions.
     */
    public function scopeOutgoing($query)
    {
        return $query->where('type', self::TYPE_OUTGOING);
    }


    /**
     * Scope for incoming commissions.
     */
    public function scopeIncoming($query)
    {
        return $query->where('type', self::TYPE_INCOMING);
    }

    /**
     * Get the consignee branch.
     */
    public function consigneeBranch()
    {
        return $this->belongsTo(Branch::class, 'consignee_branch_id');
    }
}
