<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Gate;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $rol): Response
    {

        if (!Auth::check() || Auth::user()->rol !== $rol) {
            abort(403, 'No tienes permiso para acceder a esta pagina!!.');
        }

        return $next($request);
    }
}
