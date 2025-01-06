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

    protected static ?string $navigationGroup = 'Gestión de Juegos';

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
                    ->getStateUsing(fn ($record) => $record->game && $record->game->type === 'group' ? $record->team_name : null),

                // Crear dinámicamente las columnas para los miembros
                ...self::getDynamicMemberColumns(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Estado de Pago')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'verificado' => 'Aprobado',
                    ]),
            ]);
    }

    // Función para crear dinámicamente las columnas según los miembros
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
                }),
            range(0, $maxColumns - 1)
        );
    }





    public static function canViewAny(): bool
    {
        return auth()->user()?->role === 'coordinator' or auth()->user()?->role === 'admin';
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
