<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Resources\FinancialBalanceResource\Pages\FinancialBalance;


#Route::get('/',[HomeController::class, 'index']) ;
Route::get('/', function () {
    return view('welcome');
});


