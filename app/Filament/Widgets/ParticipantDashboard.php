<?php

namespace App\Filament\Widgets;

use App\Models\Inscription;
use Filament\Widgets\Widget;

class ParticipantDashboard extends Widget
{
    protected static function getHeading(): ?string
    {
        return 'Estado de Mis Inscripciones';
    }

    protected static string $view = 'filament.widgets.participant-dashboard';

    public $pending = [];
    public $verified = [];
    public $rejected = [];
    public $selectedGameId = null;

    /**
     * Controla si el widget puede ser visto por el usuario actual.
     */
    public static function canView(): bool
    {
        return auth()->user()?->role === 'participant';
    }

    /**
     * Método que se ejecuta al inicializar el widget.
     */
    public function mount(): void
    {
        $userId = auth()->id();

        // Consulta las inscripciones del usuario autenticado
        $this->pending = Inscription::where('user_id', $userId)
            ->where('status', 'pendiente')
            ->with('game')
            ->get();

        $this->verified = Inscription::where('user_id', $userId)
            ->where('status', 'verificado')
            ->with('game')
            ->get();

        $this->rejected = Inscription::where('user_id', $userId)
            ->where('status', 'rechazado')
            ->with('game')
            ->get();
    }

    /**
     * Alterna la visualización de los detalles del juego.
     */
    public function showGameDetails($gameId): void
    {
        $this->selectedGameId = $this->selectedGameId === $gameId ? null : $gameId;
    }
}
