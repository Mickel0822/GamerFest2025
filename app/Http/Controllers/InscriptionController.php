<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InscriptionController extends Controller
{
    /**
     * Muestra el formulario de inscripción.
     */
    public function index()
    {
        // Obtener los juegos disponibles
        $games = \DB::table('games')->get();

        return view('inscriptions.index', compact('games'));
    }

    /**
     * Guarda una nueva inscripción en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'team_name' => 'nullable|string|max:255',
            'member_1_id' => 'nullable|exists:users,id',
            'member_2_id' => 'nullable|exists:users,id',
            'member_3_id' => 'nullable|exists:users,id',
            'member_4_id' => 'nullable|exists:users,id',
            'cost' => 'required|numeric|min:0',
            'payment_receipt' => 'required|file|mimes:jpg,png|max:2048', // Archivo de imagen JPG/PNG, máximo 2 MB
        ]);

        // Subir el comprobante de pago
        $paymentReceiptPath = $request->file('payment_receipt')->store('receipts', 'public');

        // Guardar la inscripción
        \DB::table('inscriptions')->insert([
            'user_id' => Auth::id(),
            'game_id' => $request->input('game_id'),
            'team_name' => $request->input('team_name'),
            'member_1_id' => $request->input('member_1_id'),
            'member_2_id' => $request->input('member_2_id'),
            'member_3_id' => $request->input('member_3_id'),
            'member_4_id' => $request->input('member_4_id'),
            'cost' => $request->input('cost'),
            'status' => 'pendiente',
            'payment_receipt' => $paymentReceiptPath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('inscriptions.index')->with('success', 'Inscripción realizada con éxito.');
    }
}
