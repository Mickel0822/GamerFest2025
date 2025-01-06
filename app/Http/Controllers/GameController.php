<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        // Obtener todos los juegos y patrocinadores
        $games = Game::all();
        $sponsors = Sponsor::all();

        // Pasar los datos a la vista
        return view('welcome', [
            'games' => $games,
            'sponsors' => $sponsors,
        ]);
    }
}
