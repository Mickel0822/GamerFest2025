<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function upload(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'game' => 'required|string',
            'proof' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ]);

        // Guardar el archivo en el almacenamiento público
        $file = $request->file('proof');
        $filePath = $file->store('payments', 'public'); // Guardado en 'storage/app/public/payments'

        // Aquí podrías guardar el comprobante en la base de datos
        // Ejemplo (si tienes una tabla 'payments'):
        // Payment::create([
        //     'game' => $request->input('game'),
        //     'file_path' => $filePath,
        // ]);

        // Mensaje de confirmación
        return back()->with('success', 'Comprobante subido correctamente.');
    }
}

