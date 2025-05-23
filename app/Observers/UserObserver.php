<?php

namespace App\Observers;

use App\Models\User;
use App\Models\BranchSetting;
use Illuminate\Support\Facades\Auth;


class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $employeeIDPrefix = 'EMP';
        $settings = BranchSetting::where([['user_id', '=', Auth::id()]])->first();
        if ($settings != NULL) {
            $employeeIDPrefix = $settings?->prefix_employee_id;
        }
        $userId = $employeeIDPrefix . '-' . $user->id;


        if ($user->user_type == 'admin') {
            $user->assignRole('admin');
        }

        if ($user->user_type == 'branch-user') {
            $user->assignRole('branchuser');
        }

        //manage user ID
        $user->userId = $userId;
        $user->save();
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
