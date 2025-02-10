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




// Página principal
Route::get('/', [GameController::class, 'index'])->name('home');

// Registro de usuarios
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Cerrar sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Subir comprobantes de pago
Route::post('/upload-receipt', [FileUploadController::class, 'uploadReceipt'])->name('upload-receipt');

// Ruta para subir comprobantes de pago
Route::post('/upload-payment', [PaymentController::class, 'upload'])->name('upload.payment');

// Ruta para el botón de Inscripción
Route::get('/inscripciones', [InscriptionController::class, 'index'])->name('inscriptions.index');
Route::post('/inscripciones', [InscriptionController::class, 'store'])->name('inscriptions.store');

// Detalles de los juegos
Route::get('/game/{id}/details', [GameController::class, 'show'])->name('game.details');

Route::get('/api/games-events', function() {
    return App\Models\Game::all()->map(function($game) {
        return [
            'title' => $game->name,
            'start' => $game->start_time,
            'end' => $game->end_time,
            'status' => $game->status,
            'location' => $game->location,
        ];
    });
});



Route::get('/test-translation', function () {
    return trans('Financial Baaalance');
});
