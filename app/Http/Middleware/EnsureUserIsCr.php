<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsCr
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('cr')->check()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
} 