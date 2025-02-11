<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReporteResource\Pages;
use App\Models\Inscription;
use App\Models\Game;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Tables\Filters\SelectFilter;

class ReporteResource extends Resource
{
    protected static ?string $model = Inscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Lista de Inscritos';
    protected static ?string $pluralLabel = 'Lista de Inscritos';
    protected static ?string $singularLabel = 'Lista de Inscritos';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationGroup = 'Reportes';

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Nombre'),
                Tables\Columns\TextColumn::make('user.last_name')->label('Apellido'),
                Tables\Columns\TextColumn::make('user.email')->label('Correo Electrónico'),
                Tables\Columns\TextColumn::make('game.name')->label('Juego'),
                Tables\Columns\TextColumn::make('team_name')->label('Equipo'),
                Tables\Columns\TextColumn::make('cost')->label('Costo'),
                Tables\Columns\TextColumn::make('status')->label('Estado'),
            ])
            ->filters([
                SelectFilter::make('game_id')
                    ->label('Seleccione un Juego')
                    ->options(fn () => Game::pluck('name', 'id')->toArray())

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
            'index' => Pages\ListReportes::route('/'),
        ];
    }
}
