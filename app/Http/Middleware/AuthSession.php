<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthSession
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('user')) {
            return redirect('/login')->with('error', 'Debes iniciar sesión para acceder.');
        }

        return $next($request);
    }
}
