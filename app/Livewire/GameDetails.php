<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Game;

class GameDetails extends Component
{
    // Variable para almacenar el ID del juego cuyo detalle se mostrará
    public $gameDetailsId = null;

    // Función para alternar los detalles de un juego
    public function toggleDetails($gameId)
    {
        // Si el ID del juego es el mismo que el actual, lo ocultamos, si no lo mostramos
        if ($this->gameDetailsId === $gameId) {
            $this->gameDetailsId = null;
        } else {
            $this->gameDetailsId = $gameId;
        }
    }

    public function render()
    {
        // Obtener todos los juegos
        $games = Game::all();

        return view('livewire.game-details', compact('games'));
    }
}
