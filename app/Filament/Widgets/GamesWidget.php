<?php

namespace App\Filament\Widgets;

use App\Models\Game;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;

class GamesWidget extends BaseWidget
{
    // Método para cambiar el título del widget
    protected function getTableHeading(): string
    {
        return 'Reporte de Juegos'; // Cambia "Games" por "Juegos"
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                Game::with('inscriptions') // Relación con los participantes
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre del Juego')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Estado')
                    ->colors([
                        'success' => 'activo',
                        'warning' => 'pausado',
                        'danger' => 'finalizado',
                    ])
                    ->formatStateUsing(function (string $state): string {
                        return match ($state) {
                            'activo' => 'Activo',
                            'pausado' => 'Pausado',
                            'finalizado' => 'Finalizado',
                            default => $state,
                        };
                    }),
                Tables\Columns\TextColumn::make('coordinator.name')
                    ->label('Coordinador')
                    ->sortable(),
                Tables\Columns\TextColumn::make('inscriptions_count') // Nueva columna: Participantes
                    ->label('Participantes')
                    ->counts('inscriptions') // Cuenta la relación 'inscriptions'
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->label('Inicio')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_time') // Nueva columna: Fecha de Finalización
                    ->label('Finalización')
                    ->dateTime() // Formatear como fecha y hora
                    ->sortable(),
            ]);
    }
}
