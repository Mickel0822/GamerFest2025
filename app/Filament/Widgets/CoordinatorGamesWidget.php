<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;

class CoordinatorGamesWidget extends Widget
{
    protected string $heading = 'Juegos del Coordinador';

    // Tamaño del widget
    protected int|string|array $columnSpan = 2;

    
    public static function canView(): bool
    {
        return auth()->user()?->role === 'coordinator';
    }
    
    public function getData(): array
    {
        // 1. Obtener el usuario logueado
        $user = Auth::user();
    
        // Depurar el usuario autenticado
        dd($user);
    
        if (!$user) {
            return [
                'message' => 'No se pudo identificar al usuario logueado.',
            ];
        }
    
        // 2. Obtener los juegos en los que es coordinador
        $games = Game::where('coordinator_id', $user->id)
            ->with('inscriptions.user')
            ->get();
    
        // Depurar la consulta de los juegos
        dd($games);
    
        if ($games->isEmpty()) {
            return [
                'message' => 'No se te han asignado juegos.',
            ];
        }
    
        return [
            'games' => $games,
        ];
    }
    
    
    protected static string $view = 'filament.widgets.coordinator-games-widget';
}
