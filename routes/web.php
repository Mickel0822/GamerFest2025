<?php
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RulesController;

Route::get('/rules', [RulesController::class, 'show'])->name('rules.show');




Route::get('/', [GameController::class, 'index'])->name('home');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);





Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::post('/upload-receipt', [FileUploadController::class, 'uploadReceipt'])->name('upload-receipt');






// Ruta para subir comprobantes de pago
Route::post('/upload-payment', [PaymentController::class, 'upload'])->name('upload.payment');

// Ruta para el botón de Inscripción
Route::get('/inscripciones', [InscriptionController::class, 'index'])->name('inscriptions.index');
Route::post('/inscripciones', [InscriptionController::class, 'store'])->name('inscriptions.store');
