<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EsAdministrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && strtolower(auth()->user()->tipo) === 'administrador') {
            return $next($request);
        }

        abort(403, 'Acceso denegado: solo administradores.');
    }
}
