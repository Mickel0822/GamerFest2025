<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InscriptionResource\Pages;
use App\Filament\Resources\InscriptionResource\RelationManagers;
use App\Models\Inscription;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\Game;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Resources\Resource;
use Filament\Tables;
use App\Models\TeamMember;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InscriptionResource extends Resource
{
    protected static ?string $model = Inscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    protected static ?string $pluralLabel = 'Inscripciones';
    protected static ?string $singularLabel = 'Inscripcion';
    protected static ?string $navigationLabel = '¡Inscribete Ahora!';
    protected static ?int $navigationSort = 4; // Cambia el orden
    protected static ?string $navigationGroup = 'Inscribirse Nuevo Juego'; // Grupo del menú

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('game_id')
                ->label('Juego')
                ->relationship('game', 'name')
                ->preload()
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $set) =>
                    $set('cost', Game::find($state)?->type === 'group' ? 25.00 : 3.00)
                ),

            TextInput::make('cost')
                ->label('Costo')
                ->readOnly()
                ->required(),

            TextInput::make('team_name')
                ->label('Nombre del Equipo')
                ->visible(fn ($get) => Game::find($get('game_id'))?->type === 'group'),

            Select::make('members')
                ->label('Miembros del Equipo')
                ->multiple()
                ->options(User::where('id', '!=', auth()->id())->pluck('name', 'id')) // Opciones de usuarios
                ->visible(fn ($get) => \App\Models\Game::find($get('game_id'))?->type === 'group')
                ->helperText('Seleccione los miembros adicionales del equipo.')
                ->required(fn ($get) => \App\Models\Game::find($get('game_id'))?->type === 'group')
                ->default([]) // Asegura que sea un array vacío por defecto
                ->rule('distinct')
                ->rule('exists:users,id') // Asegurar que los usuarios existan
                ->extraAttributes(['name' => 'members[]'])
                ->afterStateUpdated(function ($state, callable $set, $component) {
                    $inscriptionId = $component->getContainer()->getState()['id'] ?? null;

                    if (!$inscriptionId) {
                        // No hay inscripción asociada, no limpiar directamente el campo.
                        return;
                    }

                    $gameId = Inscription::find($inscriptionId)?->game_id;

                    if (!$gameId) {
                        // No se encontró un juego asociado, no realizar operaciones adicionales.
                        return;
                    }

                    foreach ($state as $memberId) {
                        if (TeamMember::whereHas('inscription', fn ($query) =>
                            $query->where('game_id', $gameId))
                            ->where('user_id', $memberId)
                            ->exists()) {
                            $set('members', []); // Limpia el campo correctamente si hay conflicto.
                            break;
                        }
                    }
                }),

            FileUpload::make('payment_receipt')
                ->label('Comprobante de Pago (JPG)')
                ->image()
                ->disk('s3')
                ->directory('inscripcion')
                ->visibility('private')
                ->downloadable()
                ->required(),


        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('user.name')
                ->label('Participante'),

            TextColumn::make('game.name')
                ->label('Juego'),

            TextColumn::make('team_name')
                ->label('Nombre del Equipo')
                ->sortable(),

            TextColumn::make('cost')
                ->label('Costo')
                ->money('USD'),

            BadgeColumn::make('status')
                ->label('Estado')
                ->colors([
                    'success' => 'verificado',
                    'warning' => 'pendiente',
                ]),

                TextColumn::make('payment_receipt')
                ->label('Comprobante')
                ->formatStateUsing(fn () => 'Ver Comprobante')
                ->url(fn ($record) => $record->payment_receipt
                    ? Storage::disk('s3')->url($record->payment_receipt)
                    : null
                )
                ->openUrlInNewTab(),


        ])
        ->actions([

        ]);
    }

    public static function canViewAny(): bool
    {
    return auth()->user()?->role === 'participant';
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
            'index' => Pages\ListInscriptions::route('/'),
            'create' => Pages\CreateInscription::route('/create'),
        ];
    }
}
