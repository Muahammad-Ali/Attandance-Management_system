<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
        $role = $request->input('role');
        
        // Prepare credentials based on role
        if ($role === 'cr') {
            $credentials = [
                'cr_email' => $request->input('email'),
                'password' => $request->input('password')
            ];
        } else {
            $credentials = [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];
        }

        // Try to authenticate with the selected guard
        if (Auth::guard($role)->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            return match ($role) {
                'teacher' => redirect()->intended(route('teacher.dashboard')),
                'cr' => redirect()->intended(route('cr.dashboard')),
                'admin' => redirect()->intended(route('admin.dashboard')),
                'web' => redirect()->intended(route('dashboard')),
                default => redirect()->intended(route('dashboard')),
            };
        }

        // If authentication fails, redirect back with error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
