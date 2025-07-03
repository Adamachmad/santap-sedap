<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna sudah login DAN memiliki peran 'admin'
        if (auth()->check() && auth()->user()->role == 'admin') {
            // Jika ya, izinkan akses
            return $next($request);
        }

        // Jika tidak, kembalikan ke halaman utama
        return redirect('/')->with('error', 'Anda tidak memiliki hak akses admin!');
    }
}