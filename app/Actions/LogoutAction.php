<?php

namespace App\Actions;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LogoutAction
{
    /**
     * Log the user out of the application and invalidate the session.
     */
    public function __invoke(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}
