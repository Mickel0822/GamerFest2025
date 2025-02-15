<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChangueInscriptionResource\Pages;
use App\Filament\Resources\ChangueInscriptionResource\RelationManagers;
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
use App\Rules\UniqueGameInscription;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChangueInscriptionResource extends Resource
{
    protected static ?string $model = Inscription::class;
    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    protected static ?string $pluralLabel = 'Cambio de Juego';
    protected static ?string $singularLabel = 'Cambio de Juego';
    protected static ?string $navigationLabel = 'Cambio de Juego';
    protected static ?string $navigationGroup = 'CRUDS'; // Grupo del menú

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('game_id')
                ->label('Juego')
                ->options(function () {
                return \App\Models\Game::all()->mapWithKeys(function ($game) {
                $typeTranslation = $game->type === 'group' ? 'Grupal' : 'Individual';
                return [$game->id => "{$game->name} ({$typeTranslation})"];
                });
                })
                ->preload()
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $set) =>
                $set('cost', \App\Models\Game::find($state)?->type === 'group' ? 25.00 : 3.00)
                )
                ->rules([
                new UniqueGameInscription(), // Usar la regla personalizada
                ]),
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
                ->options(User::where('id', '!=', auth()->id())->pluck('name', 'id'))
                ->visible(fn ($get) => \App\Models\Game::find($get('game_id'))?->type === 'group')
                ->helperText('Seleccione los miembros adicionales del equipo.')
                ->required(fn ($get) => \App\Models\Game::find($get('game_id'))?->type === 'group')
                ->default([])
                ->rule('distinct')
                ->rule('exists:users,id')
                ->extraAttributes(['name' => 'members[]']),
            TextInput::make('receipt_number')
                ->label('Número de Comprobante')
                ->placeholder('Ingrese el número de comprobante'),
            FileUpload::make('payment_receipt')
                ->label('Comprobante de Pago (JPG)')
                ->image()
                ->disk('s3')
                ->directory('inscripcion')
                ->visibility('private')
                ->downloadable(),
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

            TextColumn::make('receipt_number')
                ->label('Número de Comprobante')
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

                ImageColumn::make('payment_receipt')
                ->label('Comprobante de Pago')
                ->disk('s3') // Asegura que estás usando S3
                ->getStateUsing(fn ($record) => $record->payment_receipt
                    ? Storage::disk('s3')->url($record->payment_receipt)
                    : null
                )
                ->size(50), // Ajusta el tamaño de la imagen en píxeles

        ])
        ->actions([

        ]);
    }

    public static function canViewAny(): bool
    {
    return auth()->user()?->role === 'admin';
    }



    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChangueInscriptions::route('/'),
            'edit' => Pages\EditChangueInscription::route('/{record}/edit'),
        ];
    }


}
