<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoordinatorParticipantsResource\Pages;
use App\Filament\Resources\CoordinatorParticipantsResource\RelationManagers;
use App\Models\CoordinatorParticipants;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Inscription;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;

class CoordinatorParticipantsResource extends Resource
{
    protected static ?string $model = Inscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Gestión de Coordinador';

    protected static ?string $navigationLabel = 'Lista de Participantes';

    protected static ?string $pluralLabel = 'Listado de Participantes Inscritos';
    protected static ?string $singularLabel = 'Listado de Participantes Inscritos';

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nombre del Participante'),

                BadgeColumn::make('status')
                    ->label('Estado de Pago')
                    ->colors([
                        'success' => 'verificado',
                        'warning' => 'pendiente',
                    ]),

                TextColumn::make('team_name')
                    ->label('Equipo')
                    ->getStateUsing(fn ($record) => $record->game && $record->game->type === 'group' ? $record->team_name : null)
                    ->visible(fn ($record) => $record && $record->game && $record->game->type === 'group'), // Solo visible si es grupal

                // Crear dinámicamente las columnas para los miembros
                ...self::getDynamicMemberColumns(),
            ])
            ->filters([

            ]);
    }


    protected static function getDynamicMemberColumns(): array
    {
        $maxColumns = 4; // Máximo de columnas a generar

        return array_map(
            fn ($index) => TextColumn::make("teamMembers.{$index}.user.name")
                ->label("Miembro " . ($index + 1))
                ->getStateUsing(function ($record) use ($index) {
                    // Solo mostrar datos si el miembro existe y el juego es grupal
                    if ($record->game && $record->game->type === 'group') {
                        $teamMember = $record->teamMembers->get($index);
                        if ($teamMember && $teamMember->user) {
                            return $teamMember->user->name;
                        }
                    }
                    return null; // Retorna null si no hay usuario o no es grupal
                })
                ->visible(fn ($record) => $record && $record->game && $record->game->type === 'group'), // Ocultar si no es grupal
            range(0, $maxColumns - 1)
        );
    }






    public static function canViewAny(): bool
    {
        return auth()->user()?->role === 'coordinator';
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
            'index' => Pages\ListCoordinatorParticipants::route('/'),
        ];
    }
}
