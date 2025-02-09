<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GanadoresResource\Pages;
use App\Models\Result;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class GanadoresResource extends Resource
{
    protected static ?string $model = Result::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Lista de Ganadores';
    protected static ?string $pluralLabel = 'Lista de Ganadores';
    protected static ?string $singularLabel = 'Lista de Ganadores';
    protected static ?int $navigationSort = 5;
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

                // Nombre completo del Jugador 1
                TextColumn::make('playerOne.user.name')
                    ->label('Jugador 1')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('playerOne.user.last_name')
                    ->label('Apellido Jugador 1')
                    ->sortable()
                    ->searchable(),

                // Nombre completo del Jugador 2
                TextColumn::make('playerTwo.user.name')
                    ->label('Jugador 2')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('playerTwo.user.last_name')
                    ->label('Apellido Jugador 2')
                    ->sortable()
                    ->searchable(),

                // Nombre completo del Ganador
                TextColumn::make('winner_name')
                    ->label('Ganador')
                    ->sortable()
                    ->searchable(),

                // Tipo de enfrentamiento
                TextColumn::make('match_type')
                    ->label('Categoría')
                    ->sortable(),
            ]);
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->role === 'coordinator' || auth()->user()?->role === 'admin';
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGanadores::route('/'),
        ];
    }
}
