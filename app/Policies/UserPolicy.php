<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAdminPanel(User $user)
    {
        return $user->isAdmin();
    }

    public function viewCommercialPanel(User $user)
    {
        return $user->isCommercial();
    }
}
