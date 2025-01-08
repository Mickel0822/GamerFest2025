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

class QuickInscriptionResource extends Resource
{
    protected static ?string $model = Inscription::class;
    protected static ?string $pluralLabel = 'Inscripción Rápida';
    protected static ?string $navigationIcon = 'heroicon-o-plus-circle';
    protected static ?string $navigationGroup = 'Gestion Tesorero';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('user_id')
                ->label('Participante')
                ->searchable()
                ->options(User::all()->pluck('name', 'id'))
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

            Select::make('members')
                ->label('Miembros del Equipo')
                ->multiple()
                ->options(\App\Models\User::pluck('name', 'id')) // Opciones de usuarios
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

            Select::make('payment_method')
                ->label('Método de Pago')
                ->options([
                    'cash' => 'Efectivo',
                    'receipt' => 'Comprobante',
                ])
                ->default('cash')
                ->required()
                ->reactive(),

            FileUpload::make('payment_receipt')
                ->label('Comprobante de Pago (JPG)')
                ->image()
                ->directory('receipts')
                ->visibility('public')
                ->downloadable()
                ->default(fn ($record) => $record ? asset('storage/' . $record->payment_receipt) : null)
                ->visible(fn (\Filament\Forms\Get $get) => $get('payment_method') === 'receipt')
                ->required(fn (\Filament\Forms\Get $get) => $get('payment_method') === 'receipt'),
        ]);
    }

    public static function canViewAny(): bool
    {
    return auth()->user()?->role === 'treasurer';
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
            'index' => Pages\ListQuickInscriptions::route('/'),
            'create' => Pages\CreateQuickInscription::route('/create'),
            'edit' => Pages\EditQuickInscription::route('/{record}/edit'),
        ];
    }
}
