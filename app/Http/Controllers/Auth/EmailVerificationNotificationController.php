<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        $resultado = null;

        if ($request->user()->hasVerifiedEmail()) {
            $resultado = redirect()->intended(route('dashboard', absolute: false));
        } else {
            $request->user()->sendEmailVerificationNotification();
            $resultado = back()->with('status', 'verification-link-sent');
        }

        return $resultado;
    }
}
