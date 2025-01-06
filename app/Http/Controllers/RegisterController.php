<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'institution' => $validated['institution'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Autenticar al usuario automáticamente después del registro
        Auth::login($user);

        // Enviar el código de 2FA al correo del usuario
        //$user->send2FAEmail();
        
        // Envía el código 2FA al correo
        if (method_exists($user, 'send2FAEmail')) {
            $user->send2FAEmail();
        }

        // Redirigir a la página de TwoFactorAuth
        return redirect()->route('sf-filament-2fa.2fa'); // Ruta registrada para TwoFactorAuth
    }
}