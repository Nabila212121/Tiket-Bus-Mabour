<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsVerifiedOrGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika user belum login, izinkan akses
        if (!Auth::check()) {
            return $next($request);
        }

        // Jika user sudah login tetapi belum diverifikasi, redirect ke halaman verifikasi
        if (Auth::check() && !Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        // Jika user sudah login dan diverifikasi, izinkan akses
        return $next($request);
    }
}
