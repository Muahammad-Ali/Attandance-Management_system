<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // This will handle the authentication
        $request->authenticate();

        // After authentication, the user is logged in
        $request->session()->regenerate();
        
        // Redirect based on role
        $role = $request->input('role');
        return match ($role) {
            'teacher' => redirect()->intended(route('teacher.dashboard')),
            'cr' => redirect()->intended(route('cr.dashboard')),
            'admin' => redirect()->intended(route('admin.dashboard')),
            default => redirect()->intended(route('dashboard')),
        };
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Determine which guard to use for logout
        if (Auth::guard('teacher')->check()) {
            Auth::guard('teacher')->logout();
        } elseif (Auth::guard('cr')->check()) {
            Auth::guard('cr')->logout();
        } else {
            Auth::logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
