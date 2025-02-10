<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuickInscriptionResource\Pages;
use App\Filament\Resources\QuickInscriptionResource\RelationManagers;
use App\Models\Inscription;
use App\Models\QuickInscription;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\User;
use App\Models\Game;
use App\Models\TeamMember;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Get;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Rules\UniqueGameInscription;

class QuickInscriptionResource extends Resource
{
    protected static ?string $model = Inscription::class;
    protected static ?string $pluralLabel = 'Inscripción efectivo';
    protected static ?string $navigationIcon = 'heroicon-o-plus-circle';
    protected static ?string $navigationGroup = 'Gestion Tesorero';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Botón para seleccionar el tipo de inscripción
            Radio::make('inscription_type')
                ->label('Seleccione el tipo de inscripción')
                ->options([
                    'individual' => 'Inscripción Individual',
                    'group' => 'Inscripción Grupal',
                ])
                ->columnSpanFull()
                ->reactive(), // Necesario para que se actualicen los campos dependientes
                //->afterStateUpdated(fn ($state, callable $set) => $set('game_id', null)), // Limpiar el juego cuando cambie el tipo de inscripción

            // Participante, visible en ambos tipos de inscripción
            Select::make('user_id')
                ->label('Participante')
                ->searchable()
                ->options(User::all()->pluck('name', 'id'))
                ->required()
                ->hidden(fn ($get) => !$get('inscription_type')),

            // Campo de juegos, solo se muestran los juegos de acuerdo al tipo de inscripción
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
                ->hidden(fn ($get) => !$get('inscription_type')), // Solo visible cuando se seleccione un tipo de inscripción

            // Solo se muestra para inscripción grupal
            TextInput::make('team_name')
                ->label('Nombre del Equipo')
                ->visible(fn ($get) => $get('inscription_type') === 'group'),

            // Miembros del equipo, solo visible para inscripción grupal y limita a 4 miembros
            Select::make('members')
                ->label('Miembros del Equipo')
                ->multiple()
                ->options(User::where('id', '!=', auth()->id())->pluck('name', 'id')) // Opciones de usuarios
                ->visible(fn ($get) => $get('inscription_type') === 'group') // Solo visible para inscripción grupal
                ->helperText('Seleccione hasta 4 miembros adicionales del equipo.')
                ->required(fn ($get) => $get('inscription_type') === 'group') // Requiere miembros si es grupal
                ->maxItems(4) // Limita la selección a 4 miembros
                ->rule('distinct') // Asegura que no haya miembros repetidos
                ->rule('exists:users,id') // Asegura que los usuarios existan
                ->extraAttributes(['name' => 'members[]']),

            // Método de pago
            Select::make('payment_method')
                ->label('Método de Pago')
                ->options([
                    'cash' => 'Efectivo',
                    'receipt' => 'Comprobante',
                ])
                ->default('cash')
                ->required()
                ->reactive()
                ->hidden(fn ($get) => !$get('inscription_type')),

            // Comprobante de pago, solo visible si el método de pago es "receipt"
            FileUpload::make('payment_receipt')
                ->label('Comprobante de Pago (JPG)')
                ->image()
                ->disk('s3')
                ->directory('inscripcion')
                ->visibility('private')
                ->downloadable()
                ->visible(fn (\Filament\Forms\Get $get) => $get('payment_method') === 'receipt')
                ->required(fn (\Filament\Forms\Get $get) => $get('payment_method') === 'receipt'),

            // Número de comprobante, visible solo si es necesario
            TextInput::make('receipt_number')
                ->label('Número de Comprobante')
                ->required()
                ->placeholder('Ingrese el número de comprobante')
                ->hidden(fn ($get) => !$get('inscription_type')), // Solo visible cuando se haya seleccionado un tipo de inscripción
        ]);
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->role === 'treasurer' or auth()->user()?->role === 'admin';
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            //'index' => Pages\ListQuickInscriptions::route('/'),
            'index' => Pages\CreateQuickInscription::route('/create'),
            //'edit' => Pages\EditQuickInscription::route('/{record}/edit'),
        ];
    }
}
