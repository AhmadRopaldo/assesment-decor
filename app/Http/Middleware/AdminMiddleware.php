<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AuthController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // DEBUG: Hapus kode ini setelah berhasil
        // Ini akan menampilkan isi ROLE Anda di layar hitam
        // dd(Auth::user()->role); 

        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Anda bukan admin, role anda: ' . Auth::user()->role);
        }

        return $next($request);
    }
}
