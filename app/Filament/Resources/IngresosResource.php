<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IngresosResource\Pages;
use App\Filament\Resources\IngresosResource\RelationManagers;
use App\Models\Expense;
use App\Models\Ingresos;
use App\Models\Inscription;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IngresosResource extends Resource
{
    protected static ?string $model = Inscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Detalle de Ingresos';
    protected static ?string $pluralLabel = 'Detalle de Ingresos';
    protected static ?string $singularLabel = 'Detalle de Ingresos';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationGroup = 'Reportes';


    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('user.name')->label('Nombre'),
            Tables\Columns\TextColumn::make('user.last_name')->label('Apellido'),
            Tables\Columns\TextColumn::make('user.email')->label('Correo Electrónico'),
            Tables\Columns\TextColumn::make('cost')->label('Costo'),
            ]);
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->role === 'treasurer' || auth()->user()?->role === 'admin';
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
            'index' => Pages\ListIngresos::route('/'),
        ];
    }
}
