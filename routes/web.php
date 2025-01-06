<?php
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InscriptionController;
use App\Filament\Pages\ParticipantDashboard;
use App\Filament\Resources\FinancialBalanceResource\Pages\FinancialBalance;

// Ruta principal
Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('/', [GameController::class, 'index']);


// Ruta para subir comprobantes de pago
Route::post('/upload-payment', [PaymentController::class, 'upload'])->name('upload.payment');

// Ruta para el botón de Inscripción
Route::get('/inscripciones', [InscriptionController::class, 'index'])->name('inscriptions.index');
Route::post('/inscripciones', [InscriptionController::class, 'store'])->name('inscriptions.store');
