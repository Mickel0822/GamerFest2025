<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    /**
     * Manejar la subida del archivo.
     */
    public function uploadReceipt(Request $request)
    {
        // Validar el archivo
        $request->validate([
            'payment_receipt' => 'required|file|mimes:jpg,jpeg,png|max:1024', // 1 MB máximo
        ]);

        // Verificar si se subió el archivo
        if ($request->hasFile('payment_receipt')) {
            // Subir el archivo al bucket S3
            $path = $request->file('payment_receipt')->store('receipts', 's3');

            // Retornar la URL del archivo
            return response()->json([
                'success' => true,
                'path' => $path,
                'url' => Storage::disk('s3')->url($path),
            ]);
        }

        // En caso de error
        return response()->json([
            'success' => false,
            'message' => 'No file uploaded.',
        ], 400);
    }
}
