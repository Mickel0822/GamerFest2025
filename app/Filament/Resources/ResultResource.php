<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResultResource\Pages;
use App\Models\Result;
use App\Models\Round;
use App\Models\GameWinner;
use App\Models\Inscription;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ResultResource extends Resource
{
    protected static ?string $model = Result::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $navigationGroup = 'Gestión de Coordinador';
    protected static ?string $navigationLabel = 'Enfrentamientos';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('winner_id')
                ->label('Ganador')
                ->options(fn ($record) => [
                    $record->player_one_id => $record->match_type === 'group'
                        ? $record->playerOne?->team_name
                        : $record->playerOne?->user?->name,

                    $record->player_two_id => $record->match_type === 'group'
                        ? $record->playerTwo?->team_name
                        : $record->playerTwo?->user?->name,
                ])
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, $set, $record) {
                    if ($record->round->type === 'final') {
                        $set('first_place', $state);
                        $set('second_place', $record->player_one_id == $state ? $record->player_two_id : $record->player_one_id);
                    }
                }),

            Select::make('third_place')
                ->label('Asignar Tercer Lugar')
                ->options(fn ($record) => $record->round->previousRound()
                    ? $record->round->previousRound()->results()->get()
                        ->filter(fn ($result) => !is_null($result->player_one_id) && !is_null($result->player_two_id) && !is_null($result->winner_id)) // Filtrar solo enfrentamientos con perdedores
                        ->flatMap(fn ($result) => [
                            $result->player_one_id,
                            $result->player_two_id
                        ])
                        ->reject(fn ($id) => $record->round->previousRound()->results()->where('winner_id', $id)->exists()) // Excluir ganadores de la ronda anterior
                        ->unique()
                        ->mapWithKeys(fn ($loserId) => [
                            $loserId => Inscription::find($loserId)?->team_name
                                ?? Inscription::find($loserId)?->user?->name
                                ?? "Desconocido"
                        ])
                    : []
                )
                ->hidden(fn ($record) => $record->round->type !== 'final') // Solo en la final
                ->required(fn ($record) => $record->round->type === 'final'),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('round.name')->label('Ronda'),

                TextColumn::make('player_one_name')
                    ->label('Jugador/Equipo 1')
                    ->getStateUsing(fn ($record) =>
                        $record->match_type === 'group'
                            ? $record->playerOne?->team_name // Si es grupal, muestra el nombre del equipo
                            : $record->playerOne?->user?->name // Si es individual, muestra el nombre del jugador
                    ),

                TextColumn::make('player_two_name')
                    ->label('Jugador/Equipo 2')
                    ->getStateUsing(fn ($record) =>
                        $record->match_type === 'group'
                            ? $record->playerTwo?->team_name
                            : $record->playerTwo?->user?->name
                    ),

                TextColumn::make('winner_name')
                    ->label('Ganador')
                    ->color('danger')
                    ->getStateUsing(fn ($record) =>
                        $record->winner?->team_name ?? $record->winner?->user?->name
                    ),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('round_id')
                    ->label('Ronda')
                    ->options(Round::all()->pluck('name', 'id'))
                    ->default(Round::latest()->first()?->id), // Filtra por la última ronda por defecto
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Registrar Resultado')
                    ->button()
                    ->color('primary'),
            ])
            ->headerActions([
                Tables\Actions\Action::make('createNextRound')
                    ->label('Crear Nueva Ronda')
                    ->button()
                    ->color('success')
                    ->visible(fn () => Round::latest()->first()?->allMatchesResolved())
                    ->url(fn () => RoundResource::getUrl('create')),
            ]);
    }



    public static function canViewAny(): bool
    {
        return auth()->user()?->role === 'coordinator';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResults::route('/'),
            'edit' => Pages\EditResult::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
