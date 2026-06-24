<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Menggunakan Facade Auth untuk menghindari garis merah di VS Code
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, tendang kembali ke dashboard dengan pesan error
        return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman tersebut.');
    }
}