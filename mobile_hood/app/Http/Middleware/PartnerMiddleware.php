<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {

            if (Auth::user()->is_partner == '1') {
                return $next($request);
            } else {
                return redirect('home')->with('message', 'Acceso denegado');
            }
        } else {
            return redirect('login')->with('message', 'Tiene que iniciar sesion para acceder a la página');
        }
        return $next($request);
    }
}
