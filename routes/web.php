<?php
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;
#estoy especificando que estoy usando ese controlador en el archivo
use  App\Http\Controllers\HomeController;

#Route::get('/',[HomeController::class, 'index']) ;
Route::get('/', function () {
    return view('welcome');
});

