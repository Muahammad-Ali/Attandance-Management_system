<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Make sure the user is logged in and has the admin role
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/login')->with('error', 'You must be logged in as an admin to access this page.');
        }

        return $next($request);
    }
}
