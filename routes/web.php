<?php
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;


Route::get('/', [GameController::class, 'index'])->name('home');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);







// Ruta para subir comprobantes de pago
Route::post('/upload-payment', [PaymentController::class, 'upload'])->name('upload.payment');

// Ruta para el botón de Inscripción
Route::get('/inscripciones', [InscriptionController::class, 'index'])->name('inscriptions.index');
Route::post('/inscripciones', [InscriptionController::class, 'store'])->name('inscriptions.store');
