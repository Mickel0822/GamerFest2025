<?php

namespace App\Filament\Widgets;

use App\Models\Inscription;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class ActivityReportWidget extends BaseWidget
{
    protected static string $title = 'Reporte de Actividades de los Participantes';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                // Obtener las inscripciones con la información de usuarios y juegos
                Inscription::with(['user', 'game'])
                    ->join('users', 'users.id', '=', 'inscriptions.user_id') // Unir con la tabla de usuarios
                    ->join('games', 'games.id', '=', 'inscriptions.game_id') // Unir con la tabla de juegos
                    ->select(
                        'inscriptions.id',
                        'users.name as participant_name', // Alias para nombre del participante
                        'games.name as game_name', // Alias para nombre del juego
                        'inscriptions.payment_method',
                        'inscriptions.created_at as registration_date',
                        'inscriptions.status as payment_status',
                        'inscriptions.cost'
                    )
            )
            ->columns([
                Tables\Columns\TextColumn::make('participant_name')
                    ->label('Participante')
                    ->searchable('users.name'), // Buscar en la columna 'name' de 'users'
                
                Tables\Columns\TextColumn::make('game_name')
                    ->label('Juego')
                    ->searchable('games.name'), // Buscar en la columna 'name' de 'games'
                
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Método de Pago')
                    ->formatStateUsing(function ($state) {
                        if (strtolower($state) == 'cash') {
                            return 'Efectivo';
                        }
                        return ucfirst($state);
                    })
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('registration_date')
                    ->label('Fecha de Inscripción')
                    ->date()
                    ->sortable(),
                
                Tables\Columns\BadgeColumn::make('payment_status')
                    ->label('Estado del Pago')
                    ->colors([
                        'warning' => 'pendiente',
                        'success' => 'verificado',
                        'danger' => 'rechazado',
                    ])
                    ->formatStateUsing(fn (string $state) => ucfirst($state)),
                
                Tables\Columns\TextColumn::make('cost')
                    ->label('Costo de Inscripción')
                    ->money('USD')
                    ->sortable(),
            ]);
    }
}
