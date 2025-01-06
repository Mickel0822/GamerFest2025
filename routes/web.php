<?php
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

use App\Filament\Resources\FinancialBalanceResource\Pages\FinancialBalance;




Route::get('/', [GameController::class, 'index']);


