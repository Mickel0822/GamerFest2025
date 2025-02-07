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
use App\Rules\UniqueGameInscription;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InscriptionResource extends Resource
{
    protected static ?string $model = Inscription::class;
    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    protected static ?string $pluralLabel = 'Inscripciones';
    protected static ?string $singularLabel = 'Inscripcion';
    protected static ?string $navigationLabel = '¡Inscribete Ahora!';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationGroup = 'Inscribirse Nuevo Juego';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Radio::make('inscription_type')
                ->label('Seleccione el tipo de inscripción')
                ->options([
                    'individual' => 'Inscripción Individual',
                    'group' => 'Inscripción Grupal',
                ])
                ->columnSpanFull()
                ->reactive(),
            Select::make('game_id')
                ->label('Juego')
                ->options(fn ($get) => Game::where('type', $get('inscription_type'))->pluck('name', 'id'))
                ->preload()
                ->reactive()
                ->hidden(fn ($get) => !$get('inscription_type'))
                ->afterStateUpdated(fn ($state, callable $set) =>
                    $set('cost', Game::find($state)?->type === 'group' ? 25.00 : 3.00)
                )
                ->rules([
                    new UniqueGameInscription(),
                ]),
            TextInput::make('cost')
                ->label('Costo')
                ->readOnly()
                ->required()
                ->hidden(fn ($get) => !$get('inscription_type')),
            TextInput::make('team_name')
                ->label('Nombre del Equipo')
                ->visible(fn ($get) => $get('inscription_type') === 'group'),
            Select::make('members')
                ->label('Miembros del Equipo')
                ->multiple()
                ->options(User::where('id', '!=', auth()->id())->pluck('name', 'id'))
                ->visible(fn ($get) => $get('inscription_type') === 'group')
                ->helperText('Seleccione hasta 4 miembros adicionales del equipo.')
                ->required(fn ($get) => $get('inscription_type') === 'group')
                ->maxItems(4) // Limita la selección a 4 jugadores
                ->rule('distinct')
                ->rule('exists:users,id')
                ->extraAttributes(['name' => 'members[]']),
            TextInput::make('receipt_number')
                ->label('Número de Comprobante')
                ->required()
                ->placeholder('Ingrese el número de comprobante')
                ->hidden(fn ($get) => !$get('inscription_type')),
            FileUpload::make('payment_receipt')
                ->label('Comprobante de Pago (JPG)')
                ->image()
                ->disk('s3')
                ->directory('inscripcion')
                ->visibility('private')
                ->downloadable()
                ->required()
                ->hidden(fn ($get) => !$get('inscription_type')),
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
            //'index' => Pages\ListInscriptions::route('/'),
            'index' => Pages\CreateInscription::route('/create'),
        ];
    }
}
