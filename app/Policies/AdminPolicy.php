<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{

    public function showAdministration(User $user): bool
    {
        return $user->isAdmin();
    }
    

}
