<?php

namespace App\Policies;

use App\Models\User;

class OrderPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user)
    {
        return $user->role_value == 1 || $user->role_value == 2;
    }
}
