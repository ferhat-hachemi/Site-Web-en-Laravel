<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;


class UserPolicy
{
    use HandlesAuthorization;
    public function view(User $user)
    {
        return true;
    }


    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
}
