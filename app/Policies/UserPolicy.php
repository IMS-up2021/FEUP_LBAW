<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function showAdministration(User $user): bool
    {
        return $user->isAdmin() || $user->isModerator();
    }

    public function showOnlyAdmin(User $user): bool
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

    public function isAuthUser(User $user): bool
    {
        return auth()->user()->id === $user->id;
    }
    
}
