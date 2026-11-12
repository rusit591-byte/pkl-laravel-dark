<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user yang login memiliki role yang sesuai
        if ($request->user() && $request->user()->role === $role) {
            return $next($request);
        }

        // Jika bukan, abort dengan error 403 (Unauthorized / Forbidden)
        abort(403, 'Akses ditolak. Halaman ini khusus untuk pembimbing.');
    }
}