<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

Route::get('/register', [App\Http\Controllers\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'register']);

Route::get('/', function () {
    return view('welcome');
});

//Cristian >> Utilizado en RegisterController.php
//Debe ser cambiado por el DASHBOARD DEL COMPETIDOR
Route::get('/welcome', function () {
    return view('welcome'); // Aquí cargas la vista de bienvenida
})->name('welcome');

//Cristian >> Esto asegura que el nombre de la ruta sf-filament-2fa.2fa esté correctamente vinculado al controlador de la página TwoFactorAuth.
Route::get('admin/two-factor-auth', [
    \Solutionforest\FilamentEmail2fa\Pages\TwoFactorAuth::class,
    '__invoke'
])->name('sf-filament-2fa.2fa');