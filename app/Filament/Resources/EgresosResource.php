<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EgresosResource\Pages;
use App\Filament\Resources\EgresosResource\RelationManagers;
use App\Models\Egresos;
use App\Models\Expense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

class EgresosResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';
    protected static ?string $navigationLabel = 'Detalle de Egresos';
    protected static ?string $pluralLabel = 'Detalle de Egresos';
    protected static ?string $singularLabel = 'Detalle de Egresos';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationGroup = 'Reportes';


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
            'index' => Pages\ListEgresos::route('/'),
        ];
    }
}
