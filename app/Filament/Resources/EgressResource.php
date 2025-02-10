<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EgressResource\Pages;
use App\Models\Expense;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

// Necesita crear un modelo para los egresos

class EgressResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static ?string $navigationGroup = 'Gestion Tesorero';
    protected static ?string $navigationIcon = 'heroicon-o-wallet'; // Ícono de egresos
    protected static ?string $pluralLabel = 'Egresos';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('description')
                ->label('Descripción')
                ->required()
                ->placeholder('Escribe una breve descripción del egreso'),

            TextInput::make('amount')
                ->label('Monto')
                ->numeric()
                ->required()
                ->placeholder('Ejemplo: 100.00'),

            TextInput::make('date')
                ->label('Fecha')
                ->type('date')
                ->required()
                ->default(now()->format('Y-m-d')), // Fecha por defecto es el día actual
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('description')
                ->label('Descripción')
                ->sortable()
                ->searchable(),

            TextColumn::make('amount')
                ->label('Monto')
                ->money('USD')
                ->sortable(),

            TextColumn::make('date')
                ->label('Fecha')
                ->date()
                ->sortable(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->role === 'treasurer' || auth()->user()?->role === 'admin';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEgresses::route('/'),
            'create' => Pages\CreateEgress::route('/create'),
            'edit' => Pages\EditEgress::route('/{record}/edit'),
        ];
    }
}
