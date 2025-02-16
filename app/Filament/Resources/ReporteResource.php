<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReporteResource\Pages;
use App\Models\Inscription;
use App\Models\Game;
use Filament\Tables;
use Filament\User;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Tables\Filters\SelectFilter;

class ReporteResource extends Resource
{
    protected static ?string $model = Inscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-face-smile';
    protected static ?string $navigationLabel = 'Lista de Inscritos';
    protected static ?string $pluralLabel = 'Lista de Inscritos';
    protected static ?string $singularLabel = 'Lista de Inscritos';
    protected static ?int $navigationSort = 1 ;
    protected static ?string $navigationGroup = 'Reportes';

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
        ->query(
            Inscription::query()
            ->selectRaw('
            users.id AS id,
            users.last_name AS last_name,
            users.name AS name,
            users.email AS email,
            GROUP_CONCAT(DISTINCT games.name ORDER BY games.name SEPARATOR ", ") AS juegos
        ')
        ->leftjoin('users', 'users.id', '=', 'inscriptions.user_id')
        ->leftjoin('games', 'games.id', '=', 'inscriptions.game_id')
        ->whereNotNull('inscriptions.user_id')
        ->where('inscriptions.status', 'verificado')
        ->when(request()->query('game_id'), function ($query, $gameId) {
            return $query->where('games.id', $gameId);
        })
        ->groupBy('users.id', 'users.last_name', 'users.name', 'users.email')
        ->orderBy('users.last_name')
)
->columns([
    Tables\Columns\TextColumn::make('last_name')->label('Apellido'),
    Tables\Columns\TextColumn::make('name')->label('Nombre'),
    Tables\Columns\TextColumn::make('email')->label('Correo Electrónico'),
    Tables\Columns\TextColumn::make('juegos')->label('Juegos Inscritos'),// Mostrar juegos concatenados

        ])
        ->filters([
            SelectFilter::make('game_id')
                ->label('Seleccione un Juego')
                ->options(fn () => Game::pluck('name', 'id')->toArray()),
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