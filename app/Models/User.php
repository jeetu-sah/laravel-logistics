<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Library\sHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'user_type',
        'password',
        'user_status',
        'term_and_condition',
        'is_signed'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


     /**
     * Get the user's full name.
     */
    protected function fullName()
    {
       return $this->first_name. " ". $this->last_name;
    }


    // public function isAdmin() {
    //     return 'isAdmin';
    // }

    /**
     * Get the user's active_role.
     */
    protected function getActiveRoleAttribute($value)
    {
        $activeRole = sHelper::activeLoggedInUserRole(Auth::user());
        $activeRoleId = $activeRole->role_id;
        $userActiveRole = $this->roles->where('id', $activeRoleId)->first();
        
        return $userActiveRole->slug;
    }
}
