<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages;
use App\Filament\Resources\ExpenseResource\RelationManagers;
use App\Models\Expense;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;
    protected static ?string $navigationIcon = 'heroicon-o-wallet'; // Cambia el ícono si lo deseas
    protected static ?string $pluralLabel = 'Egresos';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('description')
                ->label('Descripción')
                ->required()
                ->placeholder('Escribe una breve descripción del gasto'),

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
        ->filters([
            // Filtros personalizados si es necesario
        ])
        ->actions([
            Tables\Actions\EditAction::make(), // Acción para editar un gasto
            Tables\Actions\DeleteAction::make(), // Acción para eliminar un gasto
        ]);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->role === 'treasurer' or auth()->user()?->role === 'admin';
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpense::route('/create'),
            'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        $user = auth()->user();

        if ($user && $user->role === 'admin') {
            return 'CRUDS'; // Solo el admin ve este grupo
        }

        return 'Gestión Tesorero'; // Para el tesorero, no aparece en ningún grupo
    }

    public static function getNavigationSort(): ?int
    {
        $user = auth()->user();

        if ($user && $user->role === 'admin') {
            return 4; // Admin verá este recurso en la posición 6 dentro de CRUDS
        }

        return 3; // Tesorero lo verá en una posición diferente sin grupo
    }

}
