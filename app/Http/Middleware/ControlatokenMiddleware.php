<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Usuari;
use Symfony\Component\HttpFoundation\Response;

class ControlatokenMiddleware
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
        if ($request->header('Authorization')) { // Hem rebut el header d’autorització?
            $key = explode(' ', $request->header('Authorization')); // Esperam un token 'Bearer token'
            if (count($key) == 2) {
                $token = $key[1]; // key[0]->Bearer key[1]→token
            } else {
                $token = '';
            }
            $user = Usuari::where('api_token', $token)->first();
            if (!empty($user) && $token !== '') {
                return $next($request); // Usuari trobat. Token correcta. Continuam am la petició
            } else {
                return response()->json(['error' => ['auth' => 'Accés no autoritzat']], 401); // token incorrecta
            }
        } else {
            return response()->json(['error' => ['auth' => 'Token no rebut']], 401);
        }
    }
}
