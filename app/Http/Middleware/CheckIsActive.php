<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsActive
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->is_active) {
            Auth::logout();

            return redirect()->route('login')->withErrors([
                'email' => 'Akun Anda belum diaktifkan oleh admin.',
            ]);
        }

        return $next($request);
    }
}

