<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IncomeResource\Pages;
use App\Filament\Resources\IncomeResource\RelationManagers;
use App\Models\Income;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IncomeResource extends Resource
{
    protected static ?string $model = Income::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Ingresos';
    protected static ?string $pluralLabel = 'Ingresos';
    //protected static ?int $navigationSort = 2; // Cambia el orden si lo deseas

    public static function canViewAny(): bool
    {
        return auth()->user()?->role === 'treasurer' or auth()->user()?->role === 'admin';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->label('Descripción')
                    ->required()
                    ->placeholder('Ingrese la descripción del ingreso'),

                Forms\Components\TextInput::make('amount')
                    ->label('Monto')
                    ->numeric()
                    ->required()
                    ->placeholder('Ingrese el monto del ingreso'),

                Forms\Components\DatePicker::make('date')
                    ->label('Fecha')
                    ->required()
                    ->default(now()->format('Y-m-d')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Monto')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => number_format($state, 2).  'US$ '),

                Tables\Columns\TextColumn::make('date')
                    ->label('Fecha')
                    ->sortable()
                    ->date(),
            ])
            ->filters([ // Agregar filtros si es necesario
                // Filtros aquí si los deseas
            ])
            ->actions([ // Acciones aquí si las deseas
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), // Acción de eliminar
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
            'index' => Pages\ListIncomes::route('/'),
            'create' => Pages\CreateIncome::route('/create'),
            'edit' => Pages\EditIncome::route('/{record}/edit'),
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
            return 3; // Admin verá este recurso en la posición 6 dentro de CRUDS
        }

        return 2; // Tesorero lo verá en una posición diferente sin grupo
    }
}