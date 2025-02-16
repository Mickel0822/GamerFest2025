<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GanadoresResource\Pages;
use App\Models\GameWinner;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class GanadoresResource extends Resource
{
    protected static ?string $model = GameWinner::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';
    protected static ?string $navigationLabel = 'Lista de Ganadores';
    protected static ?string $pluralLabel = 'Lista de Ganadores';
    protected static ?string $singularLabel = 'Lista de Ganadores';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Reportes';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Nombre del juego
                TextColumn::make('game.name')
                    ->label('Juego')
                    ->sortable()
                    ->searchable(),

                // Primer Lugar
                TextColumn::make('first_place')
                    ->label('🥇 Primer Lugar')
                    ->sortable()
                    ->searchable(),

                // Segundo Lugar
                TextColumn::make('second_place')
                    ->label('🥈 Segundo Lugar')
                    ->sortable()
                    ->searchable(),

                // Tercer Lugar
                TextColumn::make('third_place')
                    ->label('🥉 Tercer Lugar')
                    ->sortable()
                    ->searchable(),

                // Fecha del Evento
                TextColumn::make('created_at')
                    ->label('Fecha del Evento')
                    ->date()
                    ->sortable(),
            ]);
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->role === 'coordinator' || auth()->user()?->role === 'admin';
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGanadores::route('/'),
        ];
    }
}
