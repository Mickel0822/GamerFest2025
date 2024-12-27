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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InscriptionResource extends Resource
{
    protected static ?string $model = Inscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    protected static ?string $pluralLabel = 'Incripciones';
    protected static ?string $singularLabel = 'Inscripcion';
    protected static ?int $navigationSort = 4; // Cambia el orden
    protected static ?string $navigationGroup = 'Gestion Para las Inscripciones'; // Grupo del menú

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('user_id')
                ->label('Participante')
                ->relationship('user', 'name')
                ->required(),

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

            Select::make('member_1_id')
                ->label('Miembro 1')
                ->relationship('member1', 'name')
                ->searchable()
                ->visible(fn ($get) => Game::find($get('game_id'))?->type === 'group'),

            Select::make('member_2_id')
                ->label('Miembro 2')
                ->relationship('member2', 'name')
                ->searchable()
                ->visible(fn ($get) => Game::find($get('game_id'))?->type === 'group'),

            Select::make('member_3_id')
                ->label('Miembro 3')
                ->relationship('member3', 'name')
                ->searchable()
                ->visible(fn ($get) => Game::find($get('game_id'))?->type === 'group'),

            Select::make('member_4_id')
                ->label('Miembro 4')
                ->relationship('member4', 'name')
                ->searchable()
                ->visible(fn ($get) => Game::find($get('game_id'))?->type === 'group'),

            FileUpload::make('payment_receipt')
                ->label('Comprobante de Pago (JPG)')
                ->image()
                ->directory('receipts') // Guarda en storage/app/public/receipts
                ->visibility('public') // Hace que sea accesible públicamente
                ->downloadable()
                ->default(fn ($record) => $record ? asset('storage/' . $record->payment_receipt) : null),
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

            ImageColumn::make('payment_receipt') // Usa el nombre correcto
                ->label('Comprobante')
                ->disk('public') // Especifica el disco
                ->visibility('public')
                ->url(fn ($record) => asset('storage/' . $record->payment_receipt)), // Asegura que sea visible
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListInscriptions::route('/'),
            'create' => Pages\CreateInscription::route('/create'),
            'edit' => Pages\EditInscription::route('/{record}/edit'),
        ];
    }
}
