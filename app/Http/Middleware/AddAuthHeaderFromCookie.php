<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddAuthHeaderFromCookie
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah ada cookie bernama 'jwt_token'
        if ($request->hasCookie('jwt_token')) {
            $token = $request->cookie('jwt_token');
            // Suntikkan token ke dalam header Authorization
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }

        return $next($request);
    }
}