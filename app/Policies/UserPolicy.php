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

    public function showForgetPassword()
    {
        // Check if the user is not authenticated
        if (!Auth::check()) {
            // User is not authenticated, show forget password functionality
            return view('forget-password');
        }

        // User is authenticated, you might want to redirect them to another page
        return redirect('/dashboard');
    }
    
}
