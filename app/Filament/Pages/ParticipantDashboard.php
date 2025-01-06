<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ParticipantDashboard extends Page
{
    // Configuración de la navegación en el panel de administración
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Dashboard de Participante';
    protected static ?string $slug = 'dashboard-participante';
    protected static ?string $title = 'Dashboard de Participante';
    protected static string $view = 'filament.pages.participant-dashboard';

    // Controla quién puede ver esta página
    public static function canViewAny(): bool
    {
        return auth()->user()?->role === 'treasurer' || auth()->user()?->role === 'admin';
    }

    // Proporciona datos dinámicos a la vista del dashboard
    public function getViewData(): array
    {
        // Estadísticas del jugador
        $playerStats = [
            'games_played' => 10,
            'wins' => 7,
            'losses' => 3,
            'total_score' => 3500,
            'attendance_percentage' => 85,
        ];

        // Próximos juegos
        $games = [
            [
                'name' => 'Mario Kart',
                'date' => '2025-01-20T18:00:00',
                'location' => 'Centro de Eventos',
                'image' => 'https://elsalvadorjuegosdigitales.com/wp-content/uploads/2022/12/1637861249-mario-kart-8-deluxe-nintendo-switch-300x372.jpg',
            ],
            [
                'name' => 'Super Mario Bros Wonder',
                'date' => '2025-01-25T19:00:00',
                'location' => 'Sala de Juegos',
                'image' => 'https://uruguayjuegosdigitales.com/wp-content/uploads/2023/07/Super-Mario-Bros-Wonder-Nintendo-300x375.png',
            ],
            [
                'name' => 'Super Mario Odyssey',
                'date' => '2025-01-25T19:00:00',
                'location' => 'Sala de Juegos',
                'image' => 'https://uruguayjuegosdigitales.com/wp-content/uploads/2023/07/1637859946-super-mario-odyssey-nintendo-switch-300x372.jpg',
            ],
        ];

        // Retornar los datos como un array
        return [
            'playerStats' => $playerStats,
            'games' => $games,
        ];
    }
}