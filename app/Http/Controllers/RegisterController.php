<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'university' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024', // Validar la imagen
        ]);

        // Subir la imagen si existe
        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('fotoPerfil', 's3'); // Subir a S3

           // \Log::info('Ruta del archivo en S3:', ['path' => $profilePhotoPath]);
        }

        // Crear el usuario con la ruta simplificada
        User::create([
            'name' => $validated['name'],
            'university' => $validated['university'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'profile_photo' => $profilePhotoPath, // Guardar solo la ruta relativa
        ]);



        // Redirigir con un mensaje de éxito
        return redirect()->route('home')->with('success', '¡Registro exitoso! Ahora puedes iniciar sesión.');
    }
}
