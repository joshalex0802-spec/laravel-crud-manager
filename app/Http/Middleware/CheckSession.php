<?php
namespace App\Http\Middleware;
use Closure;

class CheckSession {
   public function handle($request, Closure $next) {
    if (!session()->has('usuario_id')) {
        return redirect('/')->with('error', 'Sesión expirada. Por favor, inicia sesión.');
    }
    return $next($request);
}
}