<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas API para tu aplicación. Estas
| rutas son cargadas por el RouteServiceProvider y todas serán asignadas
| al grupo de middleware "api". ¡Crea algo increíble!
|
*/

Route::middleware('api')->get('/test', function () {
    return response()->json(['message' => 'API funcionando correctamente']);
});