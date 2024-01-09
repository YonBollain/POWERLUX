<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgenteMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->role =='Agente' && !Auth::user()->role == 'Administrador') {
            return redirect('/home')->with('error', 'No tienes permisos para entrar en ese lugar!!');
        }

        return $next($request);
    }
}
