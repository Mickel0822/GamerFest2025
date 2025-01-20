<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class RulesController extends Controller
{
    public function show(Request $request)
    {
        $gameId = $request->query('game_id'); // Obtiene el game_id de la URL
        $game = Game::find($gameId);

        if (!$game) {
            return redirect('/')->with('error', 'Juego no encontrado.');
        }

        return view('rules.show', compact('game'));
    }
}
