<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Juego;

class JuegoController extends Controller
{
    // Muestra los detalles del juego
    public function show($id)
    {
        $juego = Juego::findOrFail($id); // Encuentra el juego por ID

        return view('juegos.show', compact('juego')); // Retorna una vista con los detalles del juego
    }

    // Descarga el comprobante de inscripción
    public function downloadComprobante($id)
    {
        $juego = Juego::findOrFail($id); // Encuentra el juego por ID

        if (!$juego->comprobante) {
            abort(404, 'No se encontró el comprobante.');
        }

        $filePath = storage_path('app/public/comprobantes/' . $juego->comprobante);
        return response()->download($filePath);
    }
}

