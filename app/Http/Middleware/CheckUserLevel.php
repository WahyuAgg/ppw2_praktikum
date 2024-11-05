<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $level
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $level)
    {
        // Cek apakah user therotentikasi/ sudah login
        if (!Auth::check()) {
            return redirect('login');
        }
        // Cek apakah user bukan admin?
        if (Auth::user()->level !== $level) {
            // jika bukan admin redirect /home
            return redirect('home');
        }
        // jika admin bisa lanjut ke page dashboard
        return $next($request);
    }
}
