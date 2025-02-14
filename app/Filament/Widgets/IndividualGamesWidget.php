<?php

namespace App\Filament\Widgets;

use App\Models\Game;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;

class IndividualGamesWidget extends BaseWidget
{
    // Método para cambiar el título del widget
    protected int|string|array $columnSpan = 'full'; // Ocupa toda la fila
    protected function getTableHeading(): string
    {
        return 'Juegos Individuales'; // Cambia "Games" por "Juegos"
    }

    public static function canView(): bool
    {
        return auth()->user()?->role === 'admin';
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                Game::where('type', 'individual')->with('inscriptions') // Filtrar solo juegos individuales
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre del Juego')
                    ->sortable(),
                Tables\Columns\TextColumn::make('coordinator.name')
                    ->label('Coordinador')
                    ->sortable(),
                Tables\Columns\TextColumn::make('inscriptions_count') // Nueva columna: Participantes
                    ->label('Participantes')
                    ->counts('inscriptions') // Cuenta la relación 'inscriptions'
                    ->sortable(),
            ]);
    }
}
