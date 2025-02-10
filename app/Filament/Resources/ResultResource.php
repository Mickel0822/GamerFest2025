<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResultResource\Pages;
use App\Filament\Resources\ResultResource\RelationManagers;
use App\Models\Result;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\Round;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class ResultResource extends Resource
{
    protected static ?string $model = Result::class;
    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('winner_id')
            ->label('Ganador')
            ->options(fn ($record) => [
                $record->player_one_id => $record->playerOne?->team_name ?? $record->playerOne?->user?->name,
                $record->player_two_id => $record->playerTwo?->team_name ?? $record->playerTwo?->user?->name,
            ])
            ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        
        $user = auth()->user();

        if ($user && $user->role === 'coordinator') {
            return $table->columns([
                TextColumn::make('player_one_name')->label('Jugador/Equipo 1'), // Usa el accesor dinámico
                TextColumn::make('player_two_name')->label('Jugador/Equipo 2'), // Usa el accesor dinámico
                TextColumn::make('winner_name')->label('Ganador')->sortable(), // Usa el accesor dinámico
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Registrar Resultado')
                    ->button()
                    ->color('primary')
 
            ]);
        }

        return $table->columns([
            TextColumn::make('winner_name')->label('Ganador')->sortable(), // Usa el accesor dinámico
        ]);

    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->role === 'coordinator' or auth()->user()?->role === 'admin';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResults::route('/'),
            'edit' => Pages\EditResult::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        $user = auth()->user();

        if ($user && $user->role === 'admin') {
            return 'Reportes'; // Solo el admin ve este grupo
        }

        return null; // Para el tesorero, no aparece en ningún grupo
    }

    public static function getNavigationSort(): ?int
    {
        $user = auth()->user();

        if ($user && $user->role === 'admin') {
            return 3; // Admin verá este recurso en la posición 6 dentro de CRUDS
        }

        return 3; // Coordinador lo verá en una posición diferente sin grupo
    }

    public static function getNavigationLabel(): string
    {
        $user = auth()->user();

        if ($user && $user->role === 'admin') {
            return 'Lista de Ganadores'; // Admin 
        }

        return "Ganadores"; 
    }
}
