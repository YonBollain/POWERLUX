<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role != 'Administrador') {
            return redirect('/home')->with('error','No tienes permisos para entrar en ese lugar!!');
        }

        return $next($request);
    }
}
