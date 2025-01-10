<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Manejar el cierre de sesión del usuario.
     */
    public function logout(Request $request)
    {
        // Cerrar sesión del usuario
        Auth::logout();

        // Invalidar la sesión y regenerar el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigir al usuario a la página de inicio
        return redirect('/');
    }
}
