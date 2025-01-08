<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectAfterLogout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('admin/logout') && $request->method() === 'POST') {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();

            // Redirigir a la página principal después del logout
            return redirect('/');
        }

        return $next($request);
    }
}
