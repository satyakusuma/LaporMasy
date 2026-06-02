<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Mengecek apakah user sudah login dan rolenya adalah admin
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);
        }

        // Jika bukan admin, gagalkan akses dengan pesan error 403 Forbidden
        abort(403, 'Akses ditolak! Halaman ini khusus untuk Admin.');
    }
}