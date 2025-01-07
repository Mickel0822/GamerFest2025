<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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
            'university' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear el usuario
        User::create([
            'name' => $validated['name'],
            'university' => $validated['university'], // Guardar la universidad seleccionada
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('home')->with('success', '¡Registro exitoso! Ahora puedes iniciar sesión.');
    }
}
