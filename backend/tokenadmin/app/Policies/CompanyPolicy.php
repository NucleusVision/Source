<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Company;

use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company
     * @return bool
     */
    public function update(User $user)
    {
        foreach ($user->roles()->get() as $role)
        {
            if ($role->role == 'Super')
            {
                return true;
            }
        }
        return false;
    }
    
}
