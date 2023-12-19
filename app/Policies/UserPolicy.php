<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function showAdministration(User $user): bool
    {
        return $user->isAdmin();
    }

    public function showAppeal(User $user): bool
    {
        return $user->blocked;
    }

    public function isNotBlocked(User $user): bool
    {
        return !$user->blocked;
    }

    public function showForgetPassword(): bool
    {
        return !auth()->check();
    }
    
}
