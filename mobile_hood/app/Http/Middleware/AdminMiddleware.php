<?php

namespace App\Http\Middleware;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */



    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {

            if (Auth::user()->is_admin == '1') {
                return $next($request);
            } else {
                return redirect('home')->with('message', 'Acceso denegado, no tienes permisos de administrador');
            }
        } else {
            return redirect('login')->with('message', 'Tiene que iniciar sesion para acceder a la página');
        }
        return $next($request);
    }
}
